<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['user_id']))
{
    echo '<button id="sign-out" class="btn btn-sm btn-outline-secondary" type="button">
        Выйти
    </button>';
}
else
{
    echo '<button id="sign-in" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalAuthorization" type="button">
        Войти
    </button>
    <button id="sign-up" class="btn btn-sm btn-outline-secondary ml-2" data-toggle="modal" data-target="#modalRegistration" type="button">
        Регистрация
    </button>';
}
?>