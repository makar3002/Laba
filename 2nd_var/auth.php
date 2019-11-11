<?php
	session_start();
	require_once('php/auth/authorization.php');
	require_once('php/general/header&footer.php');
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Автомобильный гараж</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/signin.css">
    </head>
    <body>
        <?php
        echo page_auth_header();
        ?>
        <main>
            <form action = "auth.php" class="form-signin" method="post" id="form">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
                    <p>Авторизуйтесь на сайте, чтобы пользоваться всеми преимуществами сервиса</p>
                </div>

                <div class="form-label-group">
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="email" required autofocus>
                    <label for="inputEmail">Почта</label>
                </div>

                <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="password" required>
                    <label for="inputPassword">Пароль</label>
                </div>
                <?php
                if (isset($fmsg)) {
                    ?>
                    <div class = "alert alert-danger" role = "alert"> <?php echo $fmsg; ?></div>
                    <?php
                }
                ?>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Запомнить меня
                    </label>
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            </form>
        </main>
        <?php
        echo page_footer();
        ?>
    </body>
</html>
