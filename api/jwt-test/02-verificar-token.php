<?php
require_once __DIR__ .'/../vendor/autoload.php';
//en mvc incluir en el index del public


use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;

const JWT_ISSUER = 'https://davinci.edu.ar';

$token = 'qwerwqerqwrweresfhskflashflajfhklrewiruwquirhwfjskfhsajkfbdvkjdbcsdfnskjflshfrwquirlhwu';
$token = (new Parser)->parse($token);

$signer = new Sha256();
$validationData = new validationData();
$validationData->setIssuer(JWT_ISSUER);


echo 'El id del usuario del token es : ' . $token->getClaim('id') . "<br>";


  if($token->validate($validationData)){
      echo "El token es valido";
  }else
  {
      echo "no es valido ese token!!";
  }