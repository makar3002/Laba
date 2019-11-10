<?php
include_once('get_and_add_journal_data.php');
include_once('html_produce.php');
require_once('../general/database_connection.php');
require_once('../marks/get_and_add_marks_data.php');
$marks = get_marks($connection);
echo marks_select_html_produce($marks);
?>



