<?php
// Vamos a ver cómo podemos crear un token JWT.
// Primero que nada, como es un paquete de Composer, tenemos que incluir el autoload que Composer provee.
require_once __DIR__ . '/../vendor/autoload.php';

// Registramos la clase de Builder para crear el Token.
use Lcobucci\JWT\Builder;
// Registramos las clases para la encriptación.
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

// Esto podría, aún mejor, estar en un archivo externo de configuración (ej: ".env") que php levante.
const JWT_ISSUER = 'https://davinci.edu.ar';
const JWT_SECRET = '54oiuhgj0s4ero5pjgm345pñwkosjgp+s34k';

/**
 * Genera el token de JWT.
 *
 * @param int $id
 * @return \Lcobucci\JWT\Token
 */
function authGenerateJWT($id)
{
    $signer = new Sha256();
    $token = (new Builder)->issuedBy(JWT_ISSUER)
        ->withClaim('id', $id)
        ->getToken($signer, new Key(JWT_SECRET));
    return $token;
}

/**
 * Verifica si el $token es válido.
 * Si lo es, retorna un array con los datos del usuario (por ahora, el id).
 * De lo contrario, retorna false.
 *
 * @param string $token
 * @return bool|array
 */
function authVerificarJWT($token) {
    $token = (new Parser)->parse($token);

    $signer = new Sha256();
    $validationData = new ValidationData();
    $validationData->setIssuer(JWT_ISSUER);

    if($token->validate($validationData) && $token->verify($signer, JWT_SECRET)) {
        return [
            'id' => $token->getClaim('id')
        ];
    }
    return false;
}

/**
 * Trata de autenticar al usuario.
 * Si tiene éxito, retorna un array con los datos del usuario y el token de autenticación (por ahora).
 * De lo contrario, retorna false.
 *
 * @param mysqli $db
 * @param string $email
 * @param string $password
 * @return bool|array
 */
function authLogin($db, $email, $password) {
    $email = mysqli_real_escape_string($db, $email);

    $query = "SELECT * FROM usuarios
              WHERE email = '{$email}'";
    $res = mysqli_query($db, $query);

    if($fila = mysqli_fetch_assoc($res)) {
        if(password_verify($password, $fila['password'])) {

            // creamos una cookie para almacenar el token......
            $token = (string) authGenerateJWT($fila['id_usuario']);
            setcookie('token', $token, [

                'httponly' => true,
                'expires' => time() + 60*60*24, // duración de un dia
                'samesite' => 'Lax',
            ]);

            return [
                'usuario' => [
                    'id_usuario' => $fila['id_usuario'],
                    'email'     => $fila['email'],
                    'nombre'    => $fila['nombre'],

                ],

            ];
        }
    }
    return false;
}
