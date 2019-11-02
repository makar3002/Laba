<?php
include_once('php/general/check_format.php');
require_once('php/general/connect.php');
$connection = connect('authorization', 'root', ''); //подключаемся к базе
if ($_SERVER['REQUEST_METHOD'] === "POST"){
	if(isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$number = $_POST['number'];
		$mark = $_POST['mark'];
		$date = $_POST['date'];
		if (strlen($number) == 6 && check_format($mark, 'word') && check_format($date, 'date')) { //валидируем данные
			$query = "INSERT INTO cars (user_id, number, brand, date) VALUES (?, ?, ?, ?);"; //создаем запрос на получение данных
			$sdh = $connection->prepare($query);
			$sdh->execute(array($user_id, $number, $mark, $date));
		}
	}
}
?>
