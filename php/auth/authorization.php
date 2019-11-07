<?php
require_once('php/general/connect.php');
$connection = connect('database', 'root', '');
require_once('php/general/check_format.php');
if (isset($_SERVER['HTTP_REFERER'])) {
    if ($_SERVER['HTTP_REFERER'] != 'http://localhost/auth.php') $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['email']) and isset($_POST['password'])) {
            if (check_format($_POST['email'], 'email')) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $query = "SELECT * FROM users WHERE email = ?";
                $sdh = $connection->prepare($query);
                $sdh->execute(array($email));
                $row = $sdh->fetchAll()[0];
                $count = $sdh->rowCount();
                if ($count == 1) {
                    if (password_verify($password, $row[2])) {
                        $_SESSION['email'] = $email;
                        $_SESSION['user_id'] = $row[0];
                    }
                    else $fmsg = "Ошибка, неверный email или пароль";
                } elseif ($count == 0) {
                    $fmsg = "Ошибка, неверный email или пароль";
                } else {
                    $fmsg = "Ошибка, что-то пошло не так, повторите попытку позже";
                }

                if (isset($_SESSION['user_id']) && !isset($fmsg)) {
                    $email = $_SESSION['email'];
                    $location = $_SESSION['referer'];
                    header("Location: $location");
                }
            } else {
                $fmsg = "Ошибка, неверный формат почты";
            }
        }
    }
}
?>
