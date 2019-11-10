<?php
include_once('get_and_add_marks_data.php');
include_once ('html_produce.php');
require_once('../general/connect.php');
$connection = connect('database', 'root', '');
$table = get_marks($connection);
echo marks_html_produce($table);
?>
