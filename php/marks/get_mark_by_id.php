<?php
require_once('marks_table_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id']))
    {
        $mark_name = $marks_table->read_by_id(array($_POST['id']));
        if (isset($mark_name[0]))
        {
            echo $mark_name[0]['mark_name'];
        }
    }
}
