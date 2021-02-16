
<?php
require_once 'classes/Validation/Validator.php';
require_once '../Models/Mensaje.php';
require_once 'funciones/auth.php';
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
            $mensaje = new Mensaje;
            $mensaje = $mensaje->mensajesTraerPorPk($db, $_GET['id']);
            echo json_encode([
                'data' => $mensaje
            ]);
        } else {
            $mensaje = new Mensaje;
            $mensaje = $mensaje->mensajesTodos($db);
            echo json_encode([
                'data' => $mensaje
            ]);
        }
        break;

    case 'POST':
        $contenidoPost = file_get_contents('php://input');
        $postData = json_decode($contenidoPost, true);

        $validator = new \Validation\Validator($postData, [

            'detalle_mensaje'        => ['required', 'min:3'],

        ]);
        if (!$validator->passes()){
            echo json_encode([
                'success' => false,
                'errores' => $validator->getErrores()
            ]);
            exit;
        }
        $mensaje = new Mensaje;
        $exito = $mensaje->mensajesCrear($db, $postData);

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