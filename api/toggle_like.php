<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

try {
    $pdo->exec("ALTER TABLE products ADD COLUMN is_liked TINYINT(1) DEFAULT 0");
} catch(Exception $ign) {}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || empty($input['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing product ID']);
    exit;
}

$id = trim($input['id']);
$state = isset($input['is_liked']) ? ($input['is_liked'] ? 1 : 0) : null;

try {
    if ($state !== null) {
        $stmt = $pdo->prepare("UPDATE products SET is_liked = ? WHERE id = ?");
        $stmt->execute([$state, $id]);
        $newLiked = (bool)$state;
    } else {
        $stmt = $pdo->prepare("UPDATE products SET is_liked = CASE WHEN is_liked = 1 THEN 0 ELSE 1 END WHERE id = ?");
        $stmt->execute([$id]);
        
        $chk = $pdo->prepare("SELECT is_liked FROM products WHERE id = ?");
        $chk->execute([$id]);
        $row = $chk->fetch(PDO::FETCH_ASSOC);
        $newLiked = $row ? ((int)$row['is_liked'] === 1) : false;
    }

    echo json_encode(['success' => true, 'is_liked' => $newLiked]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
