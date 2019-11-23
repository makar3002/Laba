<?php
require_once('journal_database_data_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['journal_note_id']))
    {
        $journal_note_id = $_POST['journal_note_id'];
        $journal_note = Journal::getInstance()->read_by_id(array($journal_note_id));
        if (isset($journal_note[0]))
        {
            echo json_encode($journal_note[0]);
        }
    }
}