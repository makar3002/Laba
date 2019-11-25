<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/php/general/database_connection.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/general/check_format.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/auth/users_table_class.php');
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['action']))
    {
        $action = $_POST['action'];
        switch ($action)
        {
            case 'sign_in':
                if (isset($_POST['email']) and isset($_POST['password'])) {
                    Users_table::getInstance()->sign_in(array(
                        'email' => $_POST['email'],
                        'password' => $_POST['password']
                    ));
                }
                break;

            case 'sign_up':
                if (isset($_POST['email']) and isset($_POST['password'])) {
                    Users_table::getInstance()->sign_up(array(
                        'email' => $_POST['email'],
                        'password' => $_POST['password']
                    ));
                }
                break;

            case 'sign_out':
                Users_table::getInstance()->sign_out();
                break;
        }

    }
}
?>
