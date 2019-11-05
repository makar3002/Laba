<?php
include_once ('sql_requests.php');
include_once ('html_produce.php');
require_once('../general/connect.php');
$connection = connect('journal', 'root', '');
$table = get_marks_sql_request($connection);
echo marks_html_produce($table);
?>
