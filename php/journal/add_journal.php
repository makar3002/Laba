<?php
session_start();
include_once('../general/check_format.php');
include_once('sql_requests.php');
require_once('../general/connect.php');
$connection = connect('authorization', 'root', ''); //подключаемся к базе
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$number = $_POST['number'];
		$mark = $_POST['mark'];
		$date = $_POST['date'];
		if (strlen($number) == 6 && check_format($mark, 'word') && check_format($date, 'date')) { //валидируем данные
			add_sql_request($connection, $user_id, $number, $mark, $date);
		}
	}
}
?>
