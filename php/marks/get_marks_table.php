<?php
include_once('get_and_add_marks_data.php');
include_once ('html_produce.php');
require_once('../general/database_connection.php');
$table = get_marks($connection);
echo marks_html_produce($table);
?>
