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
require_once $docRoot.'/php/objects/journal_note.php';
use \Firebase\JWT\JWT;
$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";
if(!empty($jwt)){
	$decoded = JWT::decode($jwt, $key, array('HS256'));
	$journalNote = new JournalNote($data);
	$journalNote->user_id = $decoded->data->id;
	//echo $data->mark_id;
	//var_dump($journalNote);
	$ans = $journalNote->create();
	//echo $ans;
	if($ans){
			// код ответа
			http_response_code(200);
			// создание jwt
			echo json_encode(
				array(
					"message" => "Запись успешно добавлена."
				)
			);
		}
	else {
	// код ответа
	http_response_code(401);
	echo json_encode(array("message" => "Ошибка добавления."));
	}
}
else
{
	http_response_code(503);
	echo json_encode(array("message" => "Ошибка добавления."));
}
?>
