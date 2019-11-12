<?php
require_once('journal_table_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id']))
    {
        $journal_note = $journal_table->read_by_id(array($_POST['id']));
        if (isset($journal_note[0]))
        {
            echo json_encode($journal_note[0]);
        }
    }
}