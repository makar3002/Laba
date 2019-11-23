<?php
require_once('marks_database_data_class.php');
include_once ('html_produce.php');
$table = Marks::getInstance()->read();
echo marks_html_produce($table, '');
?>
