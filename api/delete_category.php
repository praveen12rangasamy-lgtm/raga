<?php
header('Content-Type: application/json');
require_once 'db_connect.php';

try {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || empty($input['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing category id']);
        exit;
    }

    $id = trim($input['id']);
    
    // 1. Delete all products belonging to this category from the database
    $delProdStmt = $pdo->prepare("DELETE FROM products WHERE LOWER(TRIM(category)) = LOWER(TRIM(?))");
    $delProdStmt->execute([$id]);

    // 2. Delete the category itself (which also removes all its sub-categories)
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
