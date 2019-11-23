<?php
include_once('html_produce.php');
require_once('../marks/marks_database_data_class.php');
$all_marks = Marks::getInstance()->read();
echo marks_select_html_produce($all_marks);
?>



