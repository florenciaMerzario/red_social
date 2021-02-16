
<?php
require_once 'classes/Validation/Validator.php';
require_once '../Models/Mensaje.php';
require_once 'funciones/auth.php';
require 'bootstrap/init.php';

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            $mensaje = new Mensaje;
            $mensaje = $mensaje->mensajesTraerPorPk($_GET['id']);
            echo json_encode([
                'data' => $mensaje
            ]);
        } else {
            $mensaje = new Mensaje;
            $mensaje = $mensaje->traerMensajesConUsuarios();
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
        $exito = $mensaje->mensajesCrear($postData);

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
        die('No existe la acción que estás buscando :/(');
}