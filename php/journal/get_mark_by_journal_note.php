<?php
require_once('../marks/html_produce.php');
require_once('../marks/marks_database_data_class.php');
require_once('journal_database_data_class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (isset($_POST['journal_note_id'])) {
        $journal_note_id =  $_POST['journal_note_id'];
        $journal_note = Journal::getInstance()->read_by_id(array($journal_note_id));
        if (!empty($journal_note))
        {
            $car_number = $journal_note[0]['number'];
            $mark = Marks::getInstance()->read_by_id(array($journal_note[0]['mark_id']));
            echo marks_html_produce($mark, 'byJournalNote', $car_number);
        }
    }
}
?>
