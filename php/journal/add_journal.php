<?php
session_start();
require_once('../general/check_format.php');
require_once('sql_requests.php');
require_once('../general/connect.php');
require_once('../marks/sql_requests.php');
$connection = connect('journal', 'root', ''); //подключаемся к базе
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$number = $_POST['number'];
		$mark = $_POST['mark'];
		$date = $_POST['date'];
		$all_marks = get_marks_sql_request($connection);
		$marks_id = array_column($all_marks, 'id');
		if (mb_strlen($number) == 6 && check_format($date, 'date') && in_array($mark, $marks_id)) { //валидируем данные

			add_journal_note_sql_request($connection, $user_id, $number, $mark, $date);
		}
	}
}
?>
