<?php
session_start();
require_once('journal_database_data_class.php');
require_once('../marks/marks_database_data_class.php');
require_once('../general/check_format.php');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    var_dump($_SESSION);
    if(isset($_POST['id']) && isset($_POST['number']) && isset($_POST['mark']) && isset($_POST['date']) && isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id'];
        $id = $_POST['id'];
        $number = $_POST['number'];
        $mark = $_POST['mark'];
        $date = $_POST['date'];

        $all_marks = Marks::getInstance()->read();
        $marks_id = array_column($all_marks, 'id');

        $journal_note = Journal::getInstance()->read_by_id(array($id));

        if ($journal_note[0]['user_id'] == $user_id && mb_strlen($number) == 6 && check_format($date, 'date') && in_array($mark, $marks_id)) { //валидируем данные
            Journal::getInstance()->update(array($number, $mark, $date, $id));
        }


    }
}
?>