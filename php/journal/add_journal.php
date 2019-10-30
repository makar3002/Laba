<?php

require_once('php/general/connect.php');
$connection = connect1('authorization', 'root', '');
include_once('php/auth/check_format.php');
if ($_SERVER['REQUEST_METHOD'] === "POST"){
	if(isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
		$number = $_POST['number'];
		$mark = $_POST['mark'];
		$date = $_POST['date'];
		$is_date = DateTime::createFromFormat('YYYY-mm-dd', $date);
		$query = "INSERT INTO cars (user_id, number, brand, date) VALUES (?, ?, ?, ?);";
		$sdh = $connection->prepare($query);
		//if (strlen($number) == 6 && check_format($mark, 'string') && $is_date)
		$sdh->execute(array($user_id, $number, $mark, $date));
	}
}


?>
