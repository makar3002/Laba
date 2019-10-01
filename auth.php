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
            <a class="my-0 mr-md-auto font-weight-normal text-light" href = "index.html">ГаражQ</a>
        </header>
        <main>
            <form class="form-signin">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
                    <p>Авторизуйтесь на сайте, чтобы пользоваться всеми преимуществами сервиса</p>
                </div>

                <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputEmail">Почта</label>
                </div>

                <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Пароль</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Запомнить меня
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            </form>
        </main>
        <?php
        session_start();
        require ('php/connect.php');
        include ('php/check_format.php');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                if (check_format($_POST['email'], 'email'))
                    
            }
        }
        ?>
        <footer class="page-footer">
            <section class="copyright">
                © 2019 Mathfuc
            </section>
        </footer>
    </body>
</html>
