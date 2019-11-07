<?php
session_start();
require_once('get_and_add_journal_data.php');
require_once ('html_produce.php');
require_once('../general/connect.php');
require_once('../marks/get_and_add_marks_data.php');
$connection = connect('database', 'root', '');
if (isset($_SESSION['email']) && isset($_SESSION['user_id']) ) {
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
    $table = get_journal($connection, $user_id);
    echo authorized_journal_html_produce($table, $email);
} else {
    echo unauthorized_journal_html_produce();
}
?>
