<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/php/marks/marks_table_class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/journal/journal_table_class.php');

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['action']) && isset($_POST['table']))
    {
        $action = $_POST['action'];
        $table = $_POST['table'];

        switch ($table)
        {
            case 'journal':
                switch ($action)
                {

                    case 'add':
                        Journal_table::getInstance()->add(array(
                            'number' => $_POST['number'],
                            'mark' => $_POST['mark'],
                            'date' => $_POST['date'],
                            'user_id' => $_SESSION['user_id']
                        ));
                        break;

                    case 'get_by_id':
                        Journal_table::getInstance()->get_by_id(array(
                            'journal_note_id' => $_POST['journal_note_id']
                        ));
                        break;

                    case 'get_table':
                        Journal_table::getInstance()->get_table(array(
                            'email' => $_SESSION['email'],
                            'user_id' => $_SESSION['user_id']
                        ));
                        break;

                    case 'get_mark':
                        Journal_table::getInstance()->get_mark(array(
                            'journal_note_id' => $_POST['journal_note_id']
                        ));
                        break;

                    case 'change':
                        Journal_table::getInstance()->change(array(
                            'id' => $_POST['id'],
                            'number' => $_POST['number'],
                            'mark' => $_POST['mark'],
                            'date' => $_POST['date'],
                            'user_id' => $_SESSION['user_id']
                        ));
                        break;

                    case 'delete':
                        Journal_table::getInstance()->delete(array(
                            'id' => $_POST['id']
                        ));
                        break;

                    default:
                        break;
                }
                break;

            case 'marks':
                switch ($action)
                {

                    case 'add':
                        Marks_table::getInstance()->add(array(
                            'name' => $_POST['name'],
                            'file' => $_FILES['file']
                        ));
                        break;

                    case 'get_by_id':
                        Marks_table::getInstance()->get_by_id(array(
                            'mark_id' => $_POST['mark_id']
                        ));
                        break;

                    case 'get_table':
                        Marks_table::getInstance()->get_table(array());
                        break;

                    case 'get_journal_notes':
                        Marks_table::getInstance()->get_journal_notes(array(
                            'email' => $_SESSION['email'],
                            'user_id' => $_SESSION['user_id'],
                            'mark_id' => $_POST['mark_id']
                        ));
                        break;

                    case 'change':
                        Marks_table::getInstance()->change(array(
                            'id' => $_POST['id'],
                            'name' => $_POST['name'],
                            'file' => $_FILES['file']
                        ));
                        break;

                    case 'delete':
                        echo $_POST['id'];
                        Marks_table::getInstance()->delete(array(
                            'id' => $_POST['id']
                        ));
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
    }
}

