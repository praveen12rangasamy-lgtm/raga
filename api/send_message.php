<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

try {
    // Auto-create messages table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(50) DEFAULT NULL,
        email VARCHAR(255) DEFAULT NULL,
        subject VARCHAR(255) DEFAULT 'General Inquiry',
        message TEXT NOT NULL,
        is_read TINYINT(1) DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $name = trim($data['name'] ?? '');
    $phone = trim($data['phone'] ?? '');
    $email = trim($data['email'] ?? '');
    $subject = trim($data['subject'] ?? 'General Inquiry');
    $message = trim($data['message'] ?? '');

    if (empty($name) || empty($message)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Name and Message are required']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO messages (name, phone, email, subject, message, is_read, created_at) VALUES (?, ?, ?, ?, ?, 0, NOW())");
    $stmt->execute([$name, $phone, $email, $subject, $message]);
    $newId = $pdo->lastInsertId();

    echo json_encode([
        'success' => true,
        'message' => 'Your message has been sent successfully.',
        'id' => $newId
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
