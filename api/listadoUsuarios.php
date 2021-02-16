<?php
require_once 'classes/Validation/Validator.php';
require_once '../Models/UsuariosListado.php';
require_once 'funciones/file/file.php';
require 'bootstrap/init.php';

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {

            $usuario = new UsuariosListado;
            $usuario = $usuario->mensajesPorUsuario($_GET['id']);
            echo json_encode([
                'data' => $usuario
            ]);
        } else {
            $usuario = new UsuariosListado;
            $usuario = $usuario->traerTodos($db);
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