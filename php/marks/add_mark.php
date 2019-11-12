<?php
define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT']."/files/images/marks/");
require_once('marks_table_class.php');
require_once('../general/check_format.php');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['name']) && !empty($_FILES['file']))
	{
		$mark_name = $_POST['name'];
		$mark_logo = $_FILES['file'];

		if ($mark_logo['error'] !== UPLOAD_ERR_OK)
		{
			echo "Произошла ошибка!";
			exit;
		}

		$mark = $marks_table->read_by_name(array($mark_name));
		if (!empty($mark))
		{
			echo "Такая марка уже существует!";
			exit;
		}

		if (mb_strlen($mark_name) !== 0 && check_format($mark_name, 'word')) //валидируем данные
		{
			$marks_table->create(array($mark_name));
		}

		$mark = $marks_table->read_by_name(array($mark_name));
		if (empty($mark))
		{
			echo "Ошибка добавления!";
			exit;
		}

		$file_name = $mark[0]['id'].'.png';

		$success = move_uploaded_file($mark_logo['tmp_name'], UPLOAD_DIR . $file_name);
		if (!$success)
		{
			$marks_table->delete(array($mark['id']));
			echo "Не удалось сохранить файл!";
			exit;
		}

		chmod(UPLOAD_DIR . $file_name, 0644);
	}
}
?>
