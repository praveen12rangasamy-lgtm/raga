<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

// Auto-migrate schema
try {
    $pdo->exec("ALTER TABLE products ADD COLUMN subcategory VARCHAR(100) DEFAULT NULL");
} catch(Exception $ign) {}

try {
    $pdo->exec("ALTER TABLE products ADD COLUMN is_liked TINYINT(1) DEFAULT 0");
} catch(Exception $ign) {}

try {
    $pdo->exec("ALTER TABLE products ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
} catch(Exception $ign) {}

try {
    $pdo->exec("ALTER TABLE products MODIFY image LONGTEXT");
    $pdo->exec("ALTER TABLE products MODIFY hover_image LONGTEXT");
} catch(Exception $ign) {}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || empty($input['id']) || empty($input['name'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid product data: missing id or name']);
    exit;
}

$id = trim($input['id']);
$name = trim($input['name']);
$category = trim($input['category'] ?? '');
$subcategory = trim($input['subcategory'] ?? '');
$price = (float)($input['price'] ?? 0);
$original_price = isset($input['originalPrice']) && $input['originalPrice'] !== null && $input['originalPrice'] !== '' ? (float)$input['originalPrice'] : $price;
$discount = isset($input['discount']) && $input['discount'] !== null && $input['discount'] !== '' ? (int)$input['discount'] : 0;
$image = !empty($input['image']) ? $input['image'] : 'images/img-saree-red.jpg';
$hover_image = !empty($input['hover_image']) ? $input['hover_image'] : $image;
$fabric = !empty($input['fabric']) ? trim($input['fabric']) : 'Undefined';
$weave = !empty($input['weave']) ? trim($input['weave']) : 'Undefined';
$color = !empty($input['color']) ? trim($input['color']) : '';
$rating = isset($input['rating']) ? (float)$input['rating'] : 5.0;
$reviews = isset($input['reviews']) ? (int)$input['reviews'] : 0;
$description = !empty($input['description']) ? $input['description'] : 'A beautiful handcrafted piece from Raga Boutique.';
$highlights = isset($input['highlights']) ? json_encode($input['highlights']) : json_encode(["Premium Quality", "Authentic Handloom"]);
$is_liked = !empty($input['is_liked']) ? 1 : 0;

try {
    $stmt = $pdo->prepare("
        INSERT INTO products (id, name, category, subcategory, price, original_price, discount, image, hover_image, fabric, weave, color, rating, reviews, description, highlights, is_liked, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE
            name = VALUES(name),
            category = VALUES(category),
            subcategory = VALUES(subcategory),
            price = VALUES(price),
            original_price = VALUES(original_price),
            discount = VALUES(discount),
            image = VALUES(image),
            hover_image = VALUES(hover_image),
            fabric = VALUES(fabric),
            weave = VALUES(weave),
            color = VALUES(color),
            rating = VALUES(rating),
            reviews = VALUES(reviews),
            description = VALUES(description),
            highlights = VALUES(highlights),
            is_liked = VALUES(is_liked),
            created_at = NOW()
    ");
    
    $stmt->execute([
        $id, $name, $category, $subcategory, $price, $original_price, $discount, $image, $hover_image,
        $fabric, $weave, $color, $rating, $reviews, $description, $highlights, $is_liked
    ]);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
