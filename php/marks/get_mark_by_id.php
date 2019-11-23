<?php
require_once('marks_database_data_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['mark_id']))
    {
        $mark_name = Marks::getInstance()->read_by_id(array($_POST['mark_id']));

        if (isset($mark_name[0]))
        {
            echo $mark_name[0]['mark_name'];
        }
    }
}
