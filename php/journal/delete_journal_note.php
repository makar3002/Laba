<?php
require_once('journal_database_data_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    var_dump($_POST);
    if (isset($_POST['id']))
    {
        $journal_note_id = $_POST['id'];
        Journal::getInstance()->delete(array($journal_note_id));
        echo 'Всё путем';
    }
}
