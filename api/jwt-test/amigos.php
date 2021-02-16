
<?php
require_once 'classes/Validation/Validator.php';
require_once '../Models/Amigo.php';
require_once 'funciones/auth.php';
require_once 'bootstrap/init.php';

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id_usuario']) && isset($_GET['id_amigo'])) {
            $amigo = new Amigo;
            $amigos = $amigo->validarExisteRelacion($_GET['id_usuario'], $_GET['id_amigo']);

            if($amigos) {
                echo json_encode([
                    'success' => true
                ]);
            } else {
                echo json_encode([
                    'success' => false
                ]);
            }
            break;
        }elseif (isset($_GET['id'])) {
            $amigo = new Amigo;
            $amigos = $amigo->traerPorPk($_GET['id']);
            if($amigos) {
                echo json_encode([
                    'data' => $amigos
                ]);
            } else {
                echo json_encode([
                    'data' => false
                ]);
            }
        }
        /*if(isset($_GET['id_amigo'], $_GET['mensaje'])) {
            $amigo = new Amigo;
            $amigo = $amigo->traerValidados($_GET['id_amigo']);
            echo json_encode([
                'data' => $amigo
            ]);
        } */
        break;

    case 'POST':
        $contenidoPost = file_get_contents('php://input');
        $postData = json_decode($contenidoPost, true);

        $amigos = new Amigo;
        $exito = $amigos->amigoCrear($postData);
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
      /*  echo json_encode([
            'data' => $amigos
        ]);*/
        break;
    case 'PATCH':
        break;

    case 'DELETE':
        $contenidoPost = file_get_contents('php://input');
        $postData = json_decode($contenidoPost, true);

        $amigos = new Amigo;
        $exito = $amigos->amigosEliminar($db, $postData);
        if($exito) {
            echo json_encode([
                'amigo' => $amigos
            ]);
        }
        break;

    default:
        die('No existe la acción que estás buscando >:(');
}
