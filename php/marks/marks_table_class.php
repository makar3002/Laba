<?php
require_once('marks_database_data_class.php');
require_once('html_produce.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/general/check_format.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/general/table.php');
define("IMAGE_DIR", $_SERVER['DOCUMENT_ROOT'] . "/files/images/marks/");

class Marks_table extends Table
{
    protected static $instance;

    public function __construct()
    {

    }

    public static function getInstance()
    {

        if (empty(self::$instance)) {
            self::$instance = new Marks_table();
        }

        return self::$instance;
    }

    public function add($arr)
    {
        if(isset($arr['name']) && !empty($arr['file']))
        {
            $mark_name = $arr['name'];
            $mark_logo = $arr['file'];

            if ($mark_logo['error'] !== UPLOAD_ERR_OK)
            {
                echo "Произошла ошибка!";
                exit;
            }

            $mark = Marks::getInstance()->read_by_name(array($mark_name));
            if (!empty($mark))
            {
                echo "Такая марка уже существует!";
                exit;
            }

            if (mb_strlen($mark_name) !== 0 && check_format($mark_name, 'word')) //валидируем данные
            {
                Marks::getInstance()->create(array($mark_name));
            }

            $mark = Marks::getInstance()->read_by_name(array($mark_name));
            if (empty($mark))
            {
                echo "Ошибка добавления!";
                exit;
            }

            $file_name = $mark[0]['id'].'.png';

            $success = move_uploaded_file($mark_logo['tmp_name'], IMAGE_DIR . $file_name);
            if (!$success)
            {
                Marks::getInstance()->delete(array($mark['id']));
                echo "Не удалось сохранить файл!";
                exit;
            }

            chmod(IMAGE_DIR . $file_name, 0644);
        }
    }

    public function get_by_id($arr)
    {
        if (isset($arr['mark_id'])) {
            $mark_id = $arr['mark_id'];
            $note = Marks::getInstance()->read_by_id(array($mark_id));
            if (isset($note[0])) {
                echo json_encode($note[0]);
            }
        }
    }

    public function get_table($arr)
    {
        $table = Marks::getInstance()->read();
        echo marks_html_produce($table, '');
    }

    public function get_journal_notes($arr)
    {
        if (isset($arr['email']) && isset($arr['user_id']) && isset($arr['mark_id']))
        {
            $mark_id =  $arr['mark_id'];
            $mark_name = Marks::getInstance()->read_by_id(array($mark_id));
            if (!empty($mark_name))
            {
                $email = $arr['email'];
                $user_id = $arr['user_id'];
                $table = Journal::getInstance()->read_by_mark_id_and_user_id(array($mark_id, $user_id));
                echo authorized_journal_html_produce($table, $email, 'byMark', $mark_name[0]['mark_name']);
            }
        }
        else
        {
            echo unauthorized_journal_html_produce();
        }
    }

    public function change($arr)
    {
        if(isset($arr['id']) && isset($arr['name']) && isset($arr['file']))
        {
            $mark_id = (int) $arr['id'];
            $mark_name = $arr['name'];
            $file = $arr['file'];

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

            if (isset($file) && !empty($file['name']))
            {
                $mark_logo = $file;
                if ($mark_logo['error'] !== UPLOAD_ERR_OK && $mark_logo['error'] !== UPLOAD_ERR_NO_FILE)
                {
                    echo "Произошла ошибка!";
                    exit;
                }

                $file_name = $mark_id . '.png';

                $success = move_uploaded_file($mark_logo['tmp_name'], IMAGE_DIR . $file_name);
                if (!$success)
                {
                    echo "Не удалось сохранить файл1!";
                    exit;
                }

                chmod(IMAGE_DIR . $file_name, 0644);
            }
        }
    }

    public function delete($arr)
    {
        if (isset($arr['id']))
        {
            echo
            $mark_id = $arr['id'];
            $logo_path = IMAGE_DIR . $mark_id . '.png';

            if (file_exists($logo_path))
            {
                unlink($logo_path);
                Marks::getInstance()->delete(array($mark_id));
                echo 'Всё путем';
            }
        }
    }
}

?>
