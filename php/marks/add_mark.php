<?php
session_start();
include_once('../general/check_format.php');
include_once('sql_requests.php');
require_once('../general/connect.php');
$connection = connect('journal', 'root', ''); //подключаемся к базе
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['name'])){
		$mark_name = $_POST['name'];
		echo $mark_name;
		if (mb_strlen($mark_name) !== 0 && check_format($mark_name, 'word')) { //валидируем данные
			add_mark_sql_request($connection, $mark_name);
		}
	}
}
?>
