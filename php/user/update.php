<?php

header("Access-Control-Allow-Origin: http://authentication-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$docRoot=$_SERVER['DOCUMENT_ROOT'];
include_once $docRoot.'/php/libs/php-jwt-master/src/BeforeValidException.php';
include_once $docRoot.'/php/libs/php-jwt-master/src/ExpiredException.php';
include_once $docRoot.'/php/libs/php-jwt-master/src/SignatureInvalidException.php';
include_once $docRoot.'/php/libs/php-jwt-master/src/JWT.php';
require_once $docRoot.'/php/config/core.php';
require_once $docRoot.'/php/config/database.php';
require_once $docRoot.'/php/objects/user.php';
use \Firebase\JWT\JWT;
$data = json_decode(file_get_contents("php://input"));
// получаем jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
//$key лежит в config/core.php
if(!empty($jwt)){
	$decoded = JWT::decode($jwt, $key, array('HS256'));
	$user = new User($decoded);
	$ans = $user->update($data);
	if($ans){
	    // код ответа
	    http_response_code(200);
	    // создание jwt
	    $jwt = $user->generateToken($key);
	    echo json_encode(
		    array(
		        "message" => "Пользователь успешно обновлен",
	            "jwt" => $jwt
	       	)
	    );
	}
	else {
	  // код ответа
	  http_response_code(401);
	  echo json_encode(array("message" => "Ошибка создания пользователя."));
	}
}
else {
	// код ответа
	http_response_code(401);
	echo json_encode(array("message" => "Ошибка создания пользователя."));
}
  ?>
