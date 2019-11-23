<?php
require_once('journal_database_data_class.php');
require_once('html_produce.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/general/check_format.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/general/table.php');

class Journal_table extends Table
{
    protected static $instance;

    public function __construct()
    {

    }

    public static function getInstance()
    {

        if (empty(self::$instance)) {
            self::$instance = new Journal_table();
        }

        return self::$instance;
    }

    public function add($arr)
    {
        if (isset($arr['number']) && isset($arr['mark']) && isset($arr['date']) && isset($arr['user_id'])) {
            $user_id = $arr['user_id'];
            $number = $arr['number'];
            $mark = $arr['mark'];
            $date = $arr['date'];

            $all_marks = Marks::getInstance()->read();
            $marks_id = array_column($all_marks, 'id');

            if (mb_strlen($number) == 6 && check_format($date, 'date') && in_array($mark, $marks_id)) { //валидируем данные
                Journal::getInstance()->create(array($user_id, $number, $mark, $date));
            }
        }
    }

    public function get_by_id($arr)
    {
        if (isset($arr['journal_note_id'])) {
            $note_id = $arr['journal_note_id'];
            $note = Journal::getInstance()->read_by_id(array($note_id));
            if (isset($note[0])) {
                echo json_encode($note[0]);
            }
        }
    }

    public function get_table($arr)
    {
        if (isset($arr['email']) && isset($arr['user_id'])) {
            $email = $arr['email'];
            $user_id = $arr['user_id'];
            $table = Journal::getInstance()->read_by_user_id(array($user_id));
            echo authorized_journal_html_produce($table, $email);
        } else {
            echo unauthorized_journal_html_produce();
        }
    }

    public function get_mark($arr)
    {
        if (isset($arr['journal_note_id'])) {
            $journal_note_id = $arr['journal_note_id'];
            $journal_note = Journal::getInstance()->read_by_id(array($journal_note_id));
            if (!empty($journal_note)) {
                $car_number = $journal_note[0]['number'];
                $mark = Marks::getInstance()->read_by_id(array($journal_note[0]['mark_id']));
                echo marks_html_produce($mark, 'byJournalNote', $car_number);
            }
        }
    }

    public function change($arr)
    {
        if (isset($arr['id']) && isset($arr['number']) && isset($arr['mark']) && isset($arr['date']) && isset($arr['user_id'])) {
            $user_id = $arr['user_id'];
            $id = $arr['id'];
            $number = $arr['number'];
            $mark = $arr['mark'];
            $date = $arr['date'];

            $all_marks = Marks::getInstance()->read();
            $marks_id = array_column($all_marks, 'id');

            $journal_note = Journal::getInstance()->read_by_id(array($id));

            if ($journal_note[0]['user_id'] == $user_id && mb_strlen($number) == 6 && check_format($date, 'date') && in_array($mark, $marks_id)) { //валидируем данные
                Journal::getInstance()->update(array($number, $mark, $date, $id));
            }
        }
    }

    public function delete($arr)
    {
        if (isset($arr['id'])) {
            $journal_note_id = $arr['id'];
            Journal::getInstance()->delete(array($journal_note_id));
            echo 'Всё путем';
        }
    }
}

?>
