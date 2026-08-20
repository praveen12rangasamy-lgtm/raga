<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

try {
    // Auto-migrate if needed
    $columns = [
        "ALTER TABLE orders ADD COLUMN email VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE orders ADD COLUMN phone VARCHAR(50) DEFAULT NULL",
        "ALTER TABLE orders ADD COLUMN address TEXT DEFAULT NULL",
        "ALTER TABLE orders ADD COLUMN pincode VARCHAR(20) DEFAULT NULL",
        "ALTER TABLE orders ADD COLUMN city VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE orders ADD COLUMN subtotal DECIMAL(10,2) DEFAULT 0",
        "ALTER TABLE orders ADD COLUMN discount DECIMAL(10,2) DEFAULT 0",
        "ALTER TABLE orders ADD COLUMN shipping DECIMAL(10,2) DEFAULT 0",
        "ALTER TABLE orders ADD COLUMN items_detail JSON DEFAULT NULL",
        "ALTER TABLE orders ADD COLUMN product_ids JSON DEFAULT NULL",
        "ALTER TABLE orders ADD COLUMN product_name VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE orders ADD COLUMN payment_status VARCHAR(50) DEFAULT 'Success'"
    ];
    foreach ($columns as $sql) {
        try { $pdo->exec($sql); } catch(Exception $ign) {}
    }

    // Standardize legacy order IDs to Raga-001, Raga-002 format
    try {
        $rawStmt = $pdo->query("SELECT id FROM orders ORDER BY created_at ASC");
        $allRaw = $rawStmt->fetchAll(PDO::FETCH_COLUMN);
        $idx = 1;
        foreach ($allRaw as $oldId) {
            if (strpos($oldId, 'Raga-') !== 0) {
                $newId = 'Raga-' . str_pad($idx, 3, '0', STR_PAD_LEFT);
                $chk = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE id = ?");
                $chk->execute([$newId]);
                if ((int)$chk->fetchColumn() === 0) {
                    $upd = $pdo->prepare("UPDATE orders SET id = ? WHERE id = ?");
                    $upd->execute([$newId, $oldId]);
                }
            }
            $idx++;
        }
    } catch(Exception $ign) {}

    $stmt = $pdo->query("SELECT id, customer_name as customer, email, phone, address, pincode, city, items, amount, subtotal, discount, shipping, payment_method as payment, status, payment_status, product_ids, product_name, items_detail, created_at as date FROM orders ORDER BY created_at DESC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($orders as &$order) {
        if (!empty($order['product_ids'])) {
            $decoded = json_decode($order['product_ids'], true);
            $order['product_ids'] = is_array($decoded) ? $decoded : [$order['product_ids']];
        } else {
            $order['product_ids'] = [];
        }

        if (!empty($order['items_detail'])) {
            $decodedItems = json_decode($order['items_detail'], true);
            $order['items_detail'] = is_array($decodedItems) ? $decodedItems : [];
        } else {
            $order['items_detail'] = [];
        }
    }

    echo json_encode($orders);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
