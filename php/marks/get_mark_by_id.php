<?php
require_once('marks_table_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id']))
    {
        $mark_name = $marks->read_by_id(array($_POST['id']));
        echo $mark_name[0]['mark_name'];
    }
}
