
<?php
require_once 'classes/Validation/Validator.php';
require_once '../Models/MensajePrivado.php';
require_once 'funciones/auth.php';
require 'bootstrap/init.php';

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['id_usuario']) && isset($_GET['id_amigo'])) {
            $mensajePrivado = new MensajePrivado;
            $mensajePrivado = $mensajePrivado->traerMensajesPrivadosPorUsuario($_GET['id_usuario'], $_GET['id_amigo']);
            if($mensajePrivado) {
                echo json_encode([
                    'data' => $mensajePrivado
                ]);
            } else {
                echo json_encode([
                    'data' => false
                ]);
            }
        }
        else if (isset($_GET['id_usuario'])){
            $mensajePrivado = new MensajePrivado;
            $mensajePrivado = $mensajePrivado->traerPorUsuario($db, $_GET['id_usuario']);

            if($mensajePrivado) {
                echo json_encode([
                    'data' => $mensajePrivado
                ]);
            } else {
                echo json_encode([
                    'data' => false
                ]);
            }
    }
        break;
    case 'POST':
        $contenidoPost = file_get_contents('php://input');
        $postData = json_decode($contenidoPost, true);

        $validator = new \Validation\Validator($postData, [
            'mensaje'        => ['required', 'min:3'],
        ]);
        if (!$validator->passes()){
            echo json_encode([
                'success' => false,
                'errores' => $validator->getErrores()
            ]);
            exit;
        }
        $mensajePrivado = new MensajePrivado();
        $exito = $mensajePrivado->mensajesCrear($postData);

        if($exito) {
            echo json_encode([
                'success' => true
            ]);
        } else {
            echo json_encode([
                'success' => false
            ]);
        }
   }