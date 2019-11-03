<?php
session_start();
include_once('../general/check_format.php');
require_once('../general/connect.php');
$connection = connect('authorization', 'root', ''); //подключаемся к базе
if ($_SERVER['REQUEST_METHOD'] === "POST"){
	echo $_POST['number'].$_POST['mark'].$_POST['date'].$_SESSION['user_id'];
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