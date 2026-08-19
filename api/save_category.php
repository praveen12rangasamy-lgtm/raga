<?php
header('Content-Type: application/json');
require_once 'db_connect.php';

try {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || empty($input['id']) || empty($input['name'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields (id, name)']);
        exit;
    }

    try {
        $pdo->exec("ALTER TABLE categories ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    } catch(Exception $ign) {}

    $id = trim($input['id']);
    $name = trim($input['name']);
    $image = !empty($input['image']) ? trim($input['image']) : 'images/img-saree-red.jpg';
    $icon = !empty($input['icon']) ? trim($input['icon']) : '✨';
    $desc = !empty($input['description']) ? trim($input['description']) : '';
    $groups = isset($input['groups']) ? json_encode($input['groups']) : json_encode([]);

    $stmt = $pdo->prepare("INSERT INTO categories (id, name, image, icon, description, `groups`, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE name = VALUES(name), image = VALUES(image), icon = VALUES(icon), description = VALUES(description), `groups` = VALUES(`groups`), created_at = NOW()");
    
    $stmt->execute([$id, $name, $image, $icon, $desc, $groups]);

    echo json_encode(['success' => true, 'category' => [
        'id' => $id, 'name' => $name, 'image' => $image, 'icon' => $icon, 'description' => $desc
    ]]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
