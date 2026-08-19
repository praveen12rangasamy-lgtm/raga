<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? ($_GET['id'] ?? null);

    if (!$id) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Message ID is required']);
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(['success' => true, 'message' => 'Message deleted successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
