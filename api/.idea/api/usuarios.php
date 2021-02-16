<?php
require_once 'classes/Validation/Validator.php';
require_once '../Models/Usuario.php';
require_once 'bootstrap/init.php';

/*
header('Content-Type: application/json; charset=UTF-8');
//header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Origin: http://localhost:8082'); // Declaramos el origen (URL) desde el cual permitimos peticiones.
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: true');


$db = mysqli_connect('localhost', 'root', '', 'social');
mysqli_set_charset($db, 'utf8mb4');

*/
switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            $usuario = new Usuario;
            $usuario = $usuario->usuariosTraerPorPk($db, $_GET['id']);
            echo json_encode([
                'data' => $usuario
            ]);
        } else {
            $usuario = new Usuario;
            $usuario = $usuario->usuariosTodos($db);
            echo json_encode([
                'data' => $usuario
            ]);
        }
        break;

    case 'POST':
        $contenidoPost = file_get_contents('php://input');
        $postData = json_decode($contenidoPost, true);

        $validator = new \Validation\Validator($postData, [

            'nombre'        => ['required', 'min:3'],
            'password'        => ['required', 'min:3'],

        ]);
        if (!$validator->passes()){
            echo json_encode([
                'success' => false,
                'errores' => $validator->getErrores()
            ]);
            exit;
        }
        $usuario = new Usuario;
        $exito = $usuario->usuariosCrear($db, $postData);

        if($exito) {
            echo json_encode([
                'success' => true
            ]);
        } else {
            echo json_encode([
                'success' => false
            ]);
        }
        break;

    case 'PUT':
        $id = ($_GET['id']);
        $jsonData = file_get_contents('php://input');
        $putData = json_decode($jsonData, true);

        $validator = new \Validation\Validator($putData, [

            'nombre'        => ['required', 'min:3'],
            'password'        => ['required', 'min:3'],

        ]);


        if (!$validator->passes()) {
            echo json_encode([
                'success' => false,
                'errores' => $validator->getErrores()
            ]);
            exit;

        }
        $usuario = new Usuario;

        $exito = $usuario->usuariosEditar($db, $id, $putData);
        echo mysqli_error($db);
        echo json_encode([
            'success' => $exito
        ]);
        break;

    case 'PATCH':
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $usuario = new Usuario;
        $exito = $usuario->usuariosEliminar($db, $id);
        echo json_encode([
            'success' => $exito
        ]);
        break;

    default:
        die('No existe la acción que estás buscando >:(');
}