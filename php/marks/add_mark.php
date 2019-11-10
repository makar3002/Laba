<?php
define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT']."/files/images/marks/");
session_start();
include_once('../general/check_format.php');
include_once('get_and_add_marks_data.php');
require_once('../general/database_connection.php');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['name']) && !empty($_FILES['file'])){
		$mark_name = $_POST['name'];
		$mark_logo = $_FILES['file'];

		if ($mark_logo['error'] !== UPLOAD_ERR_OK){
			echo "Произошла ошибка!";
			exit;
		}

		if (mb_strlen($mark_name) !== 0 && check_format($mark_name, 'word')) { //валидируем данные
			add_mark($connection, $mark_name);
		}

		$mark = get_one_mark($connection, $mark_name);
		if (empty($mark)) {
			exit;
		}

		$file_name = $mark[0]['id'].'.png';

		$success = move_uploaded_file($mark_logo['tmp_name'], UPLOAD_DIR . $file_name);
		if (!$success) {
			echo "Не удалось сохранить файл!";
			exit;
		}

		chmod(UPLOAD_DIR . $file_name, 0644);
	}
}
?>
