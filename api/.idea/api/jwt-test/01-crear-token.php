<?php

require_once __DIR__ .'/../vendor/autoload.php';

use Lcobucci\JWT\Builder;

//registro de clases para la encriptacion
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

const JWT_SECRET = 'qwerwqerqwrweresfhskflashflajfhklrewiruwquirhwfjskfhsajkfbdvkjdbcsdfnskjflshfrwquirlhwu'; //la clave podria estar en un archivo env

$signer = new Sha256();

$token = (new Builder)->issuedBy('http://davinci.edu.ar')//quien lo emite;
                        ->withClaim('id', 1)
                        ->getToken($signer, new Key(JWT_SECRET));

echo ('el token que generamos es');
echo $token;