<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

// Ensure user is authenticated
if (!isset($_SESSION['admin_auth']) || $_SESSION['admin_auth'] !== true) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized. Please login again.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['current_password']) || !isset($input['new_password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Current password and new password are required.']);
    exit;
}

$currentPassword = $input['current_password'];
$newPassword = $input['new_password'];

if (strlen($newPassword) < 4) {
    echo json_encode(['success' => false, 'message' => 'New password must be at least 4 characters long.']);
    exit;
}

$username = isset($_SESSION['admin_user']) ? $_SESSION['admin_user'] : 'admin';

try {
    // 1. Fetch current password hash
    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        // Fallback check for 'admin'
        $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users LIMIT 1");
        $stmt->execute();
        $user = $stmt->fetch();
    }

    if (!$user || !password_verify($currentPassword, $user['password_hash'])) {
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect!']);
        exit;
    }

    // 2. Hash new password securely
    $newHash = password_hash($newPassword, PASSWORD_DEFAULT);

    // 3. Update in database
    $updateStmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    $updateStmt->execute([$newHash, $user['id']]);

    // 4. Destroy current session so they must log in with new credentials
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();

    echo json_encode([
        'success' => true,
        'message' => 'Password updated successfully in database! Please login with your new password.'
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
