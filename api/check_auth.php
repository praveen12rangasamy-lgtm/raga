<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true) {
    echo json_encode([
        'authenticated' => true,
        'user' => $_SESSION['admin_user']
    ]);
} else {
    echo json_encode([
        'authenticated' => false
    ]);
}
