<?php
session_start();
require_once('../general/check_format.php');
require_once('get_and_add_journal_data.php');
require_once('../general/connect.php');
require_once('../marks/get_and_add_marks_data.php');
$connection = connect('database', 'root', ''); //подключаемся к базе
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$number = $_POST['number'];
		$mark = $_POST['mark'];
		$date = $_POST['date'];
		$all_marks = get_marks($connection);
		$marks_id = array_column($all_marks, 'id');
		if (mb_strlen($number) == 6 && check_format($date, 'date') && in_array($mark, $marks_id)) { //валидируем данные
			add_journal_note($connection, $user_id, $number, $mark, $date);
		}
	}
}
?>
