<?php
require_once('marks_table_class.php');
include_once ('html_produce.php');
$table = $marks->read();
echo marks_html_produce($table);
?>
