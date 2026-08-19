<?php
header('Content-Type: application/json');
require_once 'db_connect.php';

try {
    // Auto-create categories table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
        id VARCHAR(100) PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        image LONGTEXT,
        icon VARCHAR(50) DEFAULT '✨',
        description TEXT,
        `groups` JSON,
        display_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");

    try {
        $pdo->exec("ALTER TABLE categories ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    } catch(Exception $ign) {}

    // Ensure image is LONGTEXT
    try {
        $pdo->exec("ALTER TABLE categories MODIFY image LONGTEXT");
    } catch(Exception $ign) {}

    // Check count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM categories");
    $count = $stmt->fetch()['count'];

    if ($count == 0) {
        // Seed default categories
        $defaults = [
            ['id' => 'sarees', 'name' => 'Sarees', 'image' => 'images/img-saree-red.jpg', 'icon' => '🥻', 'description' => 'Premium handcrafted sarees from across India', 'order' => 1],
            ['id' => 'kurtas', 'name' => 'Kurtas & Suits', 'image' => 'images/img-kurta-anarkali.jpg', 'icon' => '👗', 'description' => 'Elegant kurta sets and suit collections', 'order' => 2],
            ['id' => 'dress-materials', 'name' => 'Dress Materials', 'image' => 'images/img-saree-organza.jpg', 'icon' => '🧵', 'description' => 'Fine unstitched fabrics for custom styling', 'order' => 3],
            ['id' => 'blouses', 'name' => 'Blouses', 'image' => 'images/img-saree-banarasi.jpg', 'icon' => '✂️', 'description' => 'Designer blouses to complement your sarees', 'order' => 4],
            ['id' => 'short-kurtis', 'name' => 'Short Kurtis & Tops', 'image' => 'images/img-kurta-blue.jpg', 'icon' => '👚', 'description' => 'Trendy short kurtis and fusion tops', 'order' => 5],
            ['id' => 'new-arrivals', 'name' => 'New Arrivals', 'image' => 'images/img-saree-gold.jpg', 'icon' => '✨', 'description' => 'Latest additions to our collection', 'order' => 6],
            ['id' => 'sale', 'name' => 'Sale', 'image' => 'images/img-saree-tussar.jpg', 'icon' => '🏷️', 'description' => 'Exclusive discounts on premium pieces', 'order' => 7],
            ['id' => 'gifting', 'name' => 'Gifting', 'image' => 'images/banner1.jpg', 'icon' => '🎁', 'description' => 'Curated gifting sets for every occasion', 'order' => 8]
        ];

        $ins = $pdo->prepare("INSERT INTO categories (id, name, image, icon, description, display_order) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($defaults as $d) {
            $ins->execute([$d['id'], $d['name'], $d['image'], $d['icon'], $d['description'], $d['order']]);
        }
    }

    $stmt = $pdo->query("SELECT * FROM categories ORDER BY created_at DESC, display_order ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categories as &$cat) {
        if (isset($cat['groups']) && is_string($cat['groups'])) {
            $cat['groups'] = json_decode($cat['groups'], true) ?: [];
        } else if (!isset($cat['groups'])) {
            $cat['groups'] = [];
        }
    }

    echo json_encode($categories);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
