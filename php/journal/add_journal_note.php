<?php
session_start();
require_once('../general/check_format.php');
require_once('../marks/marks_database_data_class.php');
require_once('journal_database_data_class.php');

if ($_SERVER['REQUEST_METHOD'] == "POST"){
	var_dump($_POST);
	if(isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$number = $_POST['number'];
		$mark = $_POST['mark'];
		$date = $_POST['date'];
		$all_marks = Marks::getInstance()->read();
		$marks_id = array_column($all_marks, 'id');
		if (mb_strlen($number) == 6 && check_format($date, 'date') && in_array($mark, $marks_id)) { //валидируем данные
			Journal::getInstance()->create(array($user_id, $number, $mark, $date));
		}
	}
}
?>
