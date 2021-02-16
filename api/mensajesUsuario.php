
<?php
require_once 'classes/Validation/Validator.php';
require_once '../Models/MensajesUsuario.php';
require_once 'funciones/auth.php';
require_once 'bootstrap/init.php';

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            $mensajesUsuario = new MensajesUsuario;
            $mensajesUsuario = $mensajesUsuario->mensajesTraerPorPk($_GET['id']);
            echo json_encode([
                'data' => $mensajesUsuario
            ]);
        }
        break;

    default:
        die('No existe la acción que estás buscando >:(');
}