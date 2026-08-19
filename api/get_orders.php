<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

try {
    // Auto-migrate if needed
    try {
        $pdo->exec("ALTER TABLE orders ADD COLUMN product_ids JSON DEFAULT NULL");
    } catch(Exception $ign) {}
    try {
        $pdo->exec("ALTER TABLE orders ADD COLUMN product_name VARCHAR(255) DEFAULT NULL");
    } catch(Exception $ign) {}

    // Backfill any empty product_ids for legacy orders
    try {
        $pdo->exec("UPDATE orders SET product_ids = '[\"mszq3h57w9t\"]', product_name = 'x s' WHERE id = '#RAGA-92295531' AND (product_ids IS NULL OR product_ids = '[]' OR product_ids = '')");
        $pdo->exec("UPDATE orders SET product_ids = '[\"saree-03\"]', product_name = 'Sage Mint Organza Floral Saree' WHERE id = '#RAGA-15654517' AND (product_ids IS NULL OR product_ids = '[]' OR product_ids = '')");
    } catch(Exception $ign) {}

    $stmt = $pdo->query("SELECT id, customer_name as customer, items, amount, payment_method as payment, status, product_ids, product_name, created_at as date FROM orders ORDER BY created_at DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($orders as &$order) {
        if (!empty($order['product_ids'])) {
            $decoded = json_decode($order['product_ids'], true);
            $order['product_ids'] = is_array($decoded) ? $decoded : [$order['product_ids']];
        } else {
            $order['product_ids'] = [];
        }
    }

    echo json_encode($orders);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
