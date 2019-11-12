<?php
session_start();
require_once ('html_produce.php');
require_once('journal_table_class.php');
if (isset($_SESSION['email']) && isset($_SESSION['user_id']) ) {
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
    $table = $journal_table->read_by_user_id(array($user_id));
    echo authorized_journal_html_produce($table, $email);
} else {
    echo unauthorized_journal_html_produce();
}
?>
