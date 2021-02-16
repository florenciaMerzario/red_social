<?php
require_once 'classes/Validation/Validator.php';
require_once '../Models/Usuario.php';
require_once 'funciones/file/file.php';
require 'bootstrap/init.php';
//require_once \Api\DB\DBConnection;
/*
header('Content-Type: application/json; charset=UTF-8');
//header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Origin: http://localhost:8082'); // Declaramos el origen (URL) desde el cual permitimos peticiones.
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: true');


$db = mysqli_connect('localhost', 'root', '', 'social');
mysqli_set_charset($db, 'utf8mb4');

*/
//$db = DBConnection::getConnection();
switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            $usuario = new Usuario;
            $usuario = $usuario->usuariosTraerPorPk($_GET['id']);
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
            'email'         =>['required', 'min:3']
        ]);
        if (!$validator->passes()){
            echo json_encode([
                'success' => false,
                'errores' => $validator->getErrores()
            ]);
            exit;
        }

        // Upload de la imagen , chequeo si hay imagen

        if($postData['imagen'] !== null) {
            $postData['imagen'] = fileUploadBase64($postData['imagen'], __DIR__ . '../../proyecto1/public/imgs/');
        }
        $usuario = new Usuario;
        $exito = $usuario->usuariosCrear($postData);

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
            'nombre'            => ['required', 'min:3'],
            'password'          => ['required', 'min:3'],
            'email'             => ['required', 'min:5'],
            //'imagen'          => ['required'],
        ]);
        if (!$validator->passes()) {
            echo json_encode([
                'success' => false,
                'errores' => $validator->getErrores()
            ]);
            exit;
        }
        // Upload de la imagen , chequeo si hay imagen

      /*  echo json_encode([
            'success' =>$putData['imagen1']
        ]);*/
        if($putData['imagen'] !== null && $putData['imagen1'] == true) {
            $putData['imagen'] = fileUploadBase64($putData['imagen'], __DIR__ . '../../proyecto1/public/imgs/');
        }else{
            $putData['imagen'] = $putData['imagen'];
        }

        $usuario = new Usuario;
        $exito = $usuario->usuariosEditar($id, $putData);
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