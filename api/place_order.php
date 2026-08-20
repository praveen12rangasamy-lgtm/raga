<?php
session_start();
header('Content-Type: application/json');
require_once 'db_connect.php';

// Auto-migrate orders table schema with all rich fields
$columnsToEnsure = [
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

foreach ($columnsToEnsure as $sql) {
    try {
        $pdo->exec($sql);
    } catch (Exception $ign) {}
}

$input = json_decode(file_get_contents('php://input'), true);

$id = $input['id'] ?? '';
$customer = $input['customer'] ?? '';
$email = $input['email'] ?? '';
$phone = $input['phone'] ?? '';
$address = $input['address'] ?? '';
$pincode = $input['pincode'] ?? '';
$city = $input['city'] ?? '';
$items = (int)($input['items'] ?? 0);
$amount = (float)($input['amount'] ?? 0);
$subtotal = (float)($input['subtotal'] ?? $amount);
$discount = (float)($input['discount'] ?? 0);
$shipping = (float)($input['shipping'] ?? 0);
$payment = $input['payment'] ?? 'upi';
$status = 'Processing';
$payment_status = $input['payment_status'] ?? 'Success';
$date = $input['date'] ?? null;
$product_ids = isset($input['product_ids']) ? (is_array($input['product_ids']) ? json_encode($input['product_ids']) : $input['product_ids']) : null;
$product_name = $input['product_name'] ?? '';
$items_detail = isset($input['items_detail']) ? (is_array($input['items_detail']) ? json_encode($input['items_detail']) : $input['items_detail']) : null;

// Format order ID to start from Raga-001 if not formatted
if (empty($id) || strpos($id, '#RAGA-') === 0) {
    // Generate sequential Raga-XXX ID based on current total orders count
    try {
        $cntStmt = $pdo->query("SELECT COUNT(*) FROM orders");
        $nextNum = (int)$cntStmt->fetchColumn() + 1;
        $id = 'Raga-' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);
    } catch (Exception $e) {
        $id = 'Raga-001';
    }
}

if (empty($customer) || $items <= 0 || $amount <= 0) {
    echo json_encode(['success' => false, 'message' => 'Missing required customer or items information']);
    exit;
}

try {
    $createdAt = $date ? date('Y-m-d H:i:s', strtotime($date)) : date('Y-m-d H:i:s');
    
    $stmt = $pdo->prepare("INSERT INTO orders (id, customer_name, email, phone, address, pincode, city, items, amount, subtotal, discount, shipping, payment_method, status, payment_status, product_ids, product_name, items_detail, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id, $customer, $email, $phone, $address, $pincode, $city, $items, $amount, $subtotal, $discount, $shipping, $payment, $status, $payment_status, $product_ids, $product_name, $items_detail, $createdAt]);

    echo json_encode(['success' => true, 'order_id' => $id]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
