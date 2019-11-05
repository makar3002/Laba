<?php
include_once('sql_requests.php');
include_once('html_produce.php');
require_once('../general/connect.php');
require_once('../marks/sql_requests.php');
$connection = connect('journal', 'root', '');
$marks = get_marks_sql_request($connection);
echo marks_select_html_produce($marks);
?>



