<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

// Auto-migrate orders table schema
try {
    $pdo->exec("ALTER TABLE orders ADD COLUMN product_ids JSON DEFAULT NULL");
} catch(Exception $ign) {}

try {
    $pdo->exec("ALTER TABLE orders ADD COLUMN product_name VARCHAR(255) DEFAULT NULL");
} catch(Exception $ign) {}

$input = json_decode(file_get_contents('php://input'), true);

$id = $input['id'] ?? '';
$customer = $input['customer'] ?? '';
$items = (int)($input['items'] ?? 0);
$amount = (float)($input['amount'] ?? 0);
$payment = $input['payment'] ?? '';
$status = 'Processing';
$date = $input['date'] ?? null;
$product_ids = isset($input['product_ids']) ? (is_array($input['product_ids']) ? json_encode($input['product_ids']) : $input['product_ids']) : null;
$product_name = $input['product_name'] ?? '';

if (empty($id) || empty($customer) || $items <= 0 || $amount <= 0 || empty($payment)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

try {
    if ($date) {
        $stmt = $pdo->prepare("INSERT INTO orders (id, customer_name, items, amount, payment_method, status, product_ids, product_name, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id, $customer, $items, $amount, $payment, $status, $product_ids, $product_name, date('Y-m-d H:i:s', strtotime($date))]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO orders (id, customer_name, items, amount, payment_method, status, product_ids, product_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id, $customer, $items, $amount, $payment, $status, $product_ids, $product_name]);
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
