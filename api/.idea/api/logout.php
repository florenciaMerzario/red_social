<?php
require_once __DIR__ . '/bootstrap/init.php';
require_once 'bootstrap/init.php';


setcookie('token', null, [
    'expires' => time() - 60*60*24,
    'samesite' => 'Lax',
    'httponly' => true,
]);

echo json_encode([
    'success' => true
]);
