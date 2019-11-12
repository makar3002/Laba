<?php
session_start();
require_once('../general/check_format.php');
require_once('../marks/marks_table_class.php');
require_once('journal_table_class.php');

if ($_SERVER['REQUEST_METHOD'] == "POST"){
	var_dump($_POST);
	if(isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$number = $_POST['number'];
		$mark = $_POST['mark'];
		$date = $_POST['date'];
		$all_marks = $marks_table->read();
		$marks_id = array_column($all_marks, 'id');
		if (mb_strlen($number) == 6 && check_format($date, 'date') && in_array($mark, $marks_id)) { //валидируем данные
			$journal_table->create(array($user_id, $number, $mark, $date));
		}
	}
}
?>
