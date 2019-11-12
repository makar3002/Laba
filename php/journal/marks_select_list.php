<?php
include_once('html_produce.php');
require_once('../marks/marks_table_class.php');
$all_marks = $marks_table->read();
echo marks_select_html_produce($all_marks);
?>



