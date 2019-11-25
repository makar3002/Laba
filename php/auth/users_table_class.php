<?php
session_start();
require_once('users_database_data_class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/general/check_format.php');

class Users_table
{
    protected static $instance;

    public function __construct()
    {

    }

    public static function getInstance()
    {

        if (empty(self::$instance)) {
            self::$instance = new Users_table();
        }

        return self::$instance;
    }

    public function sign_up($arr)
    {
        if (isset($arr['email']) && isset($arr['password'])) {
            $email = $arr['email'];
            $password = $arr['password'];
            if (check_format($email, 'email') && check_format($password, 'password'))
            {
                $user = Users::getInstance()->read_by_email(array($email));
                $count = count($user);
                if ($count == 0)
                {
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    Users::getInstance()->create(array($email, $password));
                }
                else
                {
                    echo "Пользователь с такой почтой уже зарегистрирован";
                }
            }
            else
            {
                echo "Неверный формат данных";
            }
        }
    }

    public function sign_in($arr)
    {
        if (isset($arr['email']) && isset($arr['password']))
        {
            $email = $arr['email'];
            $password = $arr['password'];
            if (check_format($email, 'email') && check_format($password, 'password'))
            {
                $user = Users::getInstance()->read_by_email(array($email));
                $count = count($user);
                if ($count == 1)
                {
                    $row = $user[0];
                    if (password_verify($password, $row['password']))
                    {
                        $_SESSION['email'] = $email;
                        $_SESSION['user_id'] = $row['id'];
                    }
                    else
                    {
                        echo "Ошибка, неверный email или пароль";
                    }
                }
                elseif ($count == 0)
                {
                    echo "Ошибка, неверный email или пароль";
                }
                else
                {
                    echo "Ошибка, что-то пошло не так, повторите попытку позже";
                }
            }
            else
            {
                echo "Неверный формат данных";
            }
        }
    }

    public function sign_out()
    {
        session_start();
        session_destroy();
    }
}

?>
