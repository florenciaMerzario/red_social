
<?php

/*namespace api\bootstrap;
use api\bootstrap\DBConnection;
*/
require_once 'bootstrap/init.php';
require_once 'classes/Validation/Validator.php';
require '../Models/Comentario.php';

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
            $comentario = new Comentario;
            $comentario = $comentario->comentariosTraerPorPk($db, $_GET['id']);
            echo json_encode([
                'data' => $comentario
            ]);
        } else {
            $comentario = new Comentario;
            $comentario = $comentario->comentariosTodos($db);
            echo json_encode([
                'data' => $comentario
            ]);
        }
        break;

    case 'POST':
        $contenidoPost = file_get_contents('php://input');
        $postData = json_decode($contenidoPost, true);

        $validator = new \Validation\Validator($postData, [

            'detalle_comentario'        => ['required', 'min:3'],


        ]);
        if (!$validator->passes()){
            echo json_encode([
                'success' => false,
                'errores' => $validator->getErrores()
            ]);
            exit;
        }
        $comentario = new Comentario;
        $exito = $comentario->comentariosCrear($db, $postData);

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

        break;

    case 'PATCH':
        break;

    case 'DELETE':

        break;

    default:
        die('No existe la acción que estás buscando >:(');
}