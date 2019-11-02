<?php
session_start();
include_once ('sql_requests.php');
include_once ('html_produce.php');
require_once('../general/connect.php');
$connection = connect('authorization', 'root', '');
if (isset($_SESSION['email']) && isset($_SESSION['user_id']) ) {
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
    $table = table_sql_request($connection, $user_id);
    echo authorized_html_produce($table, $user_id);
} else {
    echo unauthorized_html_produce();
}
?>
