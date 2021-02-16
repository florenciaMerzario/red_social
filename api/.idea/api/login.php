<?php
require_once 'funciones/auth.php';
require_once 'bootstrap/init.php';
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'error' => 'Solo puede accederse por POST a esta ruta.'
    ]);
    exit;
}

$json = file_get_contents('php://input');
$postData = json_decode($json, true);

if($data = authLogin($db, $postData['email'], $postData['password'])) {
    echo json_encode([
        'success' => true,
        'data' => $data
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Los datos ingresados no son correctos.'
    ]);
}

