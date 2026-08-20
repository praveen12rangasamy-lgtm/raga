<?php
session_start();
header('Content-Type: application/json');

$isAuth = (isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true) || 
          (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) ||
          isset($_SESSION['admin_user']);

if (!$isAuth) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

require 'db_connect.php';

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? '';
$status = $input['status'] ?? '';

if (empty($id) || empty($status)) {
    echo json_encode(['success' => false, 'message' => 'Order ID and Status are required']);
    exit;
}

try {
    $chk = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE id = ?");
    $chk->execute([$id]);
    if ((int)$chk->fetchColumn() === 0) {
        // Check if legacy id without Raga- exists
        $altId = '#RAGA-' . preg_replace('/[^0-9]/', '', $id);
        $stmtAlt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmtAlt->execute([$status, $altId]);
    } else {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
