<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Автомобильный гараж</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<?php
session_start();
?>
<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
    <a class="main-label my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-light" href="autos.php">Автомобили</a>
        <a class="p-2 text-light" href="owners.php">Владельцы</a>
        <a class="p-2 text-light" href="#">Список сторожей</a>
        <a class="p-2 text-light" href="journal.php">Журнал</a>
    </nav>
    <div class="col-4 d-flex justify-content-end align-items-center">

        <a class="btn btn-sm btn-outline-secondary"
            <?php
            if (!isset($_SESSION['email'])){
            echo "href='auth.php'" ?> > Sign in</a>
        <?php
        } else {
            echo "href='php/logout.php'" ?> > Sign out</a>
            <?php
        }
        ?>
    </div>
</header>
<main>

    <article class="entry">
        <table class="table">
        <?php
        require ('php/connect.php');
        include ('php/check_format.php');
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            ?>
            <h5>Журнал с данными пользователся <?php echo "$email" ?>!</h5>
            <?php
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_row($result);
            $user_id = $row[0];
            $query = "SELECT number, brand, date FROM cars WHERE user_id = '$user_id'";
            $result = mysqli_query($connection, $query);
            $table = mysqli_fetch_all($result);
            ?>
            <tr>
                <td>Номер автомобиля</td>
                <td>Марка</td>
                <td>Дата принятия</td>
            </tr>
            <?php
            foreach ($table as $r) {
                ?>
                <tr>
                    <?php
                    foreach ($r as $f) {
                        ?>
                        <td> <?php echo "$f"?> </td>
                        <?php
                    }
                ?>
                </tr>
            <?php
            }
        } else {
            ?>
            <h5>Вы не авторизованы, авторизуйтесь, пожалуйста</h5>
            <?php
        }
        ?>
        </table>
    </article>
</main>
<footer class="border-top page-footer border-top">
    <section class="copyright">
        © 2019 Mathfuc
    </section>
</footer>
<div class="podfooter"></div>
</body>
</html>