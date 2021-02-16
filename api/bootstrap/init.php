<?php

require_once __DIR__ . '/../classes/Validation/Validator.php';

header('Content-Type: application/json; charset=UTF-8');

header('Access-Control-Allow-Origin: http://localhost:8080'); // Declaramos el origen (URL) desde el cual permitimos peticiones.
header('Access-Control-Allow-Methods: VAL, GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: true');

$db = mysqli_connect('localhost', 'root', '', 'social');
mysqli_set_charset($db, 'utf8mb4');