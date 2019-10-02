
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
        require ('php/connect.php');
        include ('php/check_format.php');
        if ($_SERVER['HTTP_REFERER'] != 'http://localhost/auth.php') $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['email']) and isset($_POST['password'])) {
                //if (check_format($_POST['email'], 'email')){
                    $email = $_POST['email'];

                    $password = mysqli_real_escape_string($connection, $_POST['password']);
                    $query = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);
                    if ($count == 1) {
                        $_SESSION['email'] = $email;
                    } else {
                        $fmsg = "Ошибка, неверный логин или пароль";
                    }

                    if (isset($_SESSION['email']) && !isset($fmsg)) {
                        $email = $_SESSION['email'];
                        $location = $_SESSION['referer'];
                        header("Location: $location");
                    }
                //}

            }
        }
        ?>

        <main>
            <form action = "auth.php" class="form-signin" method="post">
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



        <footer class="border-top page-footer border-top">
            <section class="copyright">
                © 2019 Mathfuc
            </section>
        </footer>
        <div class="podfooter"></div>
    </body>
</html>
