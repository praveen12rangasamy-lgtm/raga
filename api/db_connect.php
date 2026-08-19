<?php
// Smart Database Connection (Works seamlessly with XAMPP, WAMP, Docker, and Live Hosting)
$host = getenv('DB_HOST') ?: (file_exists('/.dockerenv') ? 'db' : 'localhost');
$db   = getenv('DB_NAME') ?: 'gradix';
$user = getenv('DB_USER') ?: (file_exists('/.dockerenv') ? 'gradix_user' : 'root');
$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : (file_exists('/.dockerenv') ? 'gradix_pass' : '');

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed", "details" => $e->getMessage()]);
    exit;
}
?>
