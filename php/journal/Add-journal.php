<?php

//В. Лично мне не нравится процедурный подход с mysql_i. Надо бы поменять на PDO
require_once('php/general/connect.php');
$connection = connect('authorization');


include_once('php/auth/check_format.php');
if ($_SERVER['REQUEST_METHOD'] === "POST"){
	if(isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['email'])){
		
		//В. Мб я кнш туплю, но раз мы храним в сессии email, то почему бы нам не хранить id пользователя и не нагружать БД?
		$email = $_SESSION['email'];
		
		$query = "SELECT * FROM users WHERE email = '$email'";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_row($result);
		$user_id = $row[0];
		
		
		$number = mysqli_real_escape_string($connection, $_POST['number']);
		$mark = mysqli_real_escape_string($connection, $_POST['mark']);
		$date = mysqli_real_escape_string($connection, $_POST['date']);
		$query = "INSERT INTO cars (user_id, number, brand, date) VALUES ('".$user_id."', '".$number."', '".$mark."', '".$date."');";
		$result = mysqli_query($connection, $query);
	}
}


?>
