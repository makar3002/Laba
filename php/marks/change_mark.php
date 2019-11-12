<?php
define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT']."/files/images/marks/");
require_once('marks_table_class.php');
require_once('../general/check_format.php');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['id']) && isset($_POST['name']))
    {
        $mark_id = (int) $_POST['id'];
        $mark_name = $_POST['name'];

        $mark = $marks_table->read_by_id(array($mark_id));
        if (empty($mark))
        {
            echo "Ошибка добавления!";
            exit;
        }

        if (mb_strlen($mark_name) !== 0 && check_format($mark_name, 'word')) //валидируем данные
        {
            $marks_table->update(array($mark_name, $mark_id));

            $mark = $marks_table->read_by_id(array($mark_id));

            if ($mark[0]['mark_name'] != $mark_name)
            {
                echo "Такая марка уже есть!";
                exit;
            }
        }

        if (isset($_FILES['file']) && !empty($_FILES['file']['name']))
        {
            $mark_logo = $_FILES['file'];
            var_dump($_FILES['file']);
            if ($mark_logo['error'] !== UPLOAD_ERR_OK && $mark_logo['error'] !== UPLOAD_ERR_NO_FILE)
            {
                echo "Произошла ошибка!";
                echo $mark_logo['error'];
                exit;
            }

            $file_name = $mark_id . '.png';

            $success = move_uploaded_file($mark_logo['tmp_name'], UPLOAD_DIR . $file_name);
            if (!$success)
            {
                echo "Не удалось сохранить файл1!";
                exit;
            }

            chmod(UPLOAD_DIR . $file_name, 0644);
        }
    }
}
?>
