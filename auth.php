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

        <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
            <a class="my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
        </header>
        <?php
        session_start();
        require_once ('php/auth/authorization.php');
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
        require_once('php/general/footer.php');
        ?>
    </body>
</html>
