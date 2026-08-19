<?php
session_start();
header('Content-Type: application/json');

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['username']) || !isset($input['password'])) {
    echo json_encode(['success' => false, 'message' => 'Missing username or password']);
    exit;
}

$username = trim($input['username']);
$password = $input['password'];

require_once 'db_connect.php';

try {
    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        // Authentication successful
        $_SESSION['admin_auth'] = true;
        $_SESSION['admin_user'] = $user['username'];
        echo json_encode(['success' => true]);
    } else {
        // Authentication failed
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
