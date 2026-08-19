<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'db_connect.php';

try {
    // Auto-migrate schema if needed
    try {
        $pdo->exec("ALTER TABLE products ADD COLUMN subcategory VARCHAR(100) DEFAULT NULL");
    } catch(Exception $ign) {}
    try {
        $pdo->exec("ALTER TABLE products ADD COLUMN is_liked TINYINT(1) DEFAULT 0");
    } catch(Exception $ign) {}
    try {
        $pdo->exec("ALTER TABLE products ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    } catch(Exception $ign) {}

    $stmt = $pdo->query('SELECT * FROM products ORDER BY created_at DESC, id DESC');
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as &$product) {
        if (!empty($product['highlights'])) {
            $product['highlights'] = json_decode($product['highlights'], true);
        } else {
            $product['highlights'] = [];
        }
        
        $product['price'] = (float)$product['price'];
        $product['originalPrice'] = (float)$product['original_price'];
        $product['discount'] = (int)$product['discount'];
        $product['rating'] = $product['rating'] !== null ? (float)$product['rating'] : 5.0;
        $product['reviews'] = (int)($product['reviews'] ?? 0);
        $product['hoverImage'] = $product['hover_image'] ?? $product['image'];
        $product['subcategory'] = $product['subcategory'] ?? '';
        $product['is_liked'] = !empty($product['is_liked']) && (int)$product['is_liked'] === 1;
        
        unset($product['original_price']);
        unset($product['hover_image']);
    }

    echo json_encode($products);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to retrieve products: " . $e->getMessage()]);
}
?>
