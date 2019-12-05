<?php 
header("Access-Control-Allow-Origin: http://authentication-jwt/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$docRoot=$_SERVER['DOCUMENT_ROOT'];
require_once $docRoot.'/php/config/database.php';
try{
    $query = "SELECT * from marks ORDER BY  id";
    $stmt = DataBase::Connection()->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    http_response_code(200);
    echo json_encode(array(
        "values" => $rows
    ));
}
catch(Exception $e){
    http_response_code(503);
    echo json_encode(array(
        "message" => $e->getMessage()
    ));
}
?>