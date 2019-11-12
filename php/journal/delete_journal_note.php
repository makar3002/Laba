<?php
require_once('journal_table_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    var_dump($_POST);
    if (isset($_POST['id']))
    {
        $journal_note_id = $_POST['id'];
        $journal_table->delete(array($journal_note_id));
        echo 'Всё путем';
    }
}
