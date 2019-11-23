<?php
define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT']."/files/images/marks/");
require_once('marks_database_data_class.php');
require_once('../general/check_format.php');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['id']) && isset($_POST['name']))
    {
        $mark_id = (int) $_POST['id'];
        $mark_name = $_POST['name'];

        $mark = Marks::getInstance()->read_by_id(array($mark_id));
        if (empty($mark))
        {
            echo "Ошибка добавления!";
            exit;
        }

        if (mb_strlen($mark_name) !== 0 && check_format($mark_name, 'word')) //валидируем данные
        {
            Marks::getInstance()->update(array($mark_name, $mark_id));

            $mark = Marks::getInstance()->read_by_id(array($mark_id));

            if ($mark[0]['mark_name'] != $mark_name)
            {
                echo "Такая марка уже есть!";
                exit;
            }
        }

        if (isset($_FILES['file']) && !empty($_FILES['file']['name']))
        {
            $mark_logo = $_FILES['file'];
            if ($mark_logo['error'] !== UPLOAD_ERR_OK && $mark_logo['error'] !== UPLOAD_ERR_NO_FILE)
            {
                echo "Произошла ошибка!";
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
