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
//echo file_get_contents("php://input");
$data = json_decode(file_get_contents("php://input"));
$jwt = isset($data->jwt) ? $data->jwt : "";
if(!empty($jwt)){
    try{
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        //$user = new User($decoded);
        //echo $user->id;
        //echo $decoded->data->id;
        $query = "SELECT journal_notes.id, number, mark_name, date, status
        FROM journal_notes
        INNER JOIN marks ON journal_notes.mark_id = marks.id
        WHERE journal_notes.user_id = ?
        ORDER BY -date";
        $stmt = DataBase::Connection()->prepare($query);
        $stmt->execute(array($decoded->data->id));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        http_response_code(200);
        echo json_encode(array(
            "values" => $rows
        ));
    }
    catch(Exception $e){
        http_response_code(401);
        echo json_encode(array(
            "message" => "Доступ закрыт.",
            "error" => $e->getMessage()
        ));
    }
}
else
{
    http_response_code(401);
    echo json_encode(array(
        "message" => "Доступ закрыт."
    ));
}

?>