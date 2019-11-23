<?php
session_start();
require_once ('html_produce.php');
require_once('journal_database_data_class.php');
if (isset($_SESSION['email']) && isset($_SESSION['user_id']) ) {
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
    $table = Journal::getInstance()->read_by_user_id(array($user_id));
    echo authorized_journal_html_produce($table, $email);
} else {
    echo unauthorized_journal_html_produce();
}
?>
