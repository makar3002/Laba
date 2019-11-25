<?php
require_once('html_produce.php');
require_once('php/journal/journal_database_data_class.php');
require_once('php/marks/marks_database_data_class.php');
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['request']))
    {
        $request = $_GET['request'];
        $user_id = '0';
        if (isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];

        $journal_note_search = Journal::getInstance()->search(array(
            ':request' => $request,
            ':user_id' => $user_id
        ));

        $marks_search = Marks::getInstance()->search(array($request));

        $data = array(
            'journal' => $journal_note_search,
            'marks' => $marks_search
        );

        echo search_html_produce($data, $request);
    }
}
?>

