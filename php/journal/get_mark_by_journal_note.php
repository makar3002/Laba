<?php
require_once('../marks/html_produce.php');
require_once('../marks/marks_table_class.php');
require_once('journal_table_class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (isset($_POST['journal_note_id'])) {
        $journal_note_id =  $_POST['journal_note_id'];
        $journal_note = $journal_table->read_by_id(array($journal_note_id));
        if (!empty($journal_note))
        {
            $car_number = $journal_note[0]['number'];
            $mark = $marks_table->read_by_id(array($journal_note[0]['mark_id']));
            echo marks_html_produce($mark, 'byJournalNote', $car_number);
        }
    }
}
?>
