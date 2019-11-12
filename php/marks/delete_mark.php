<?php
define("REMOVE_DIR", $_SERVER['DOCUMENT_ROOT'] . "/files/images/marks/");
require_once('marks_table_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id']))
    {

        $mark_id = $_POST['id'];
        $logo_path = REMOVE_DIR . $mark_id . '.png';

        if (file_exists($logo_path))
        {
            echo 1;
            unlink($logo_path);
            $marks_table->delete(array($mark_id));
            echo 'Всё путем';
        }
    }
}

