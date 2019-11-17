<?php
session_start();
require_once('../journal/html_produce.php');
require_once('../journal/journal_table_class.php');
require_once('marks_table_class.php');

if (isset($_SESSION['email']) && isset($_SESSION['user_id']) && isset($_POST['mark_id']))
{
    $mark_id =  $_POST['mark_id'];
    $mark_name = $marks_table->read_by_id(array($mark_id));
    if (!empty($mark_name))
    {
        $email = $_SESSION['email'];
        $user_id = $_SESSION['user_id'];
        $table = $journal_table->read_by_mark_id_and_user_id(array($mark_id, $user_id));
        echo authorized_journal_html_produce($table, $email, 'byMark', $mark_name[0]['mark_name']);
    }
}
else
{
    echo unauthorized_journal_html_produce();
}
?>