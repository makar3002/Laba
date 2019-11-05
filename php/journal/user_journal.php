<?php
session_start();
require_once ('sql_requests.php');
require_once ('html_produce.php');
require_once('../general/connect.php');
require_once('../marks/sql_requests.php');
$connection = connect('journal', 'root', '');
if (isset($_SESSION['email']) && isset($_SESSION['user_id']) ) {
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
    $table = get_journal_sql_request($connection, $user_id);
    $marks = get_marks_sql_request($connection);
    $marks_id = array_column($marks, 'id');
    $marks_name = array_column($marks, 'mark_name');
    $marks = array_combine($marks_id, $marks_name);
    echo authorized_html_produce($table, $email, $marks);
} else {
    echo unauthorized_html_produce();
}
?>
