<?php

header("Access-Control-Allow-Origin: http://authentication-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
require_once 'config/core.php';
require_once 'config/database.php';
require_once 'objects/user.php';
use \Firebase\JWT\JWT;
$data = json_decode(file_get_contents("php://input"));
$user = new User($data);
$ans = $user->read();
if($ans){
	$token = array(
	       "iss" => $iss,
	       "aud" => $aud,
	       "iat" => $iat,
	       "nbf" => $nbf,
	       "data" => array(
	           "id" => $user->id,
	           "firstName" => $user->firstName,
	           "lastName" => $user->lastName,
						 "nickname" =>$user->nickname,
	           "email" => $user->email
	       )
	    );
	    // код ответа
	    http_response_code(200);
	    // создание jwt
	    $jwt = JWT::encode($token, $key);
	    echo json_encode(
	        array(
	            "message" => "Успешный вход в систему.",
	            "jwt" => $jwt
	        )
	    );
	}
// Если электронная почта не существует или пароль не совпадает,
// сообщим пользователю, что он не может войти в систему
else {
  // код ответа
  http_response_code(401);
  // сказать пользователю что войти не удалось
  echo json_encode(array("message" => "Ошибка входа."));
}
  ?>
