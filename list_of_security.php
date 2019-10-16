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
    <form class="form-signin" id="form" enctype="application/x-www-form-urlencoded; charset=UTF-8" >
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Антимат</h1>
            <p>Напишите что-нибудь в поле ввода (только культурное)</p>
        </div>

        <div class="form-label-group">
            <input type="text" name="inputText" id="inputText" class="form-control" placeholder="Текст" required autofocus>
        </div>
        <button class="btn btn-lg btn-primary btn-block" id="button">Проверить</button>
    </form>

    <script src="js/anti_filth.js" type="text/javascript"></script>
</main>
<footer class="border-top page-footer border-top">
    <section class="copyright">
        © 2019 Mathfuc
    </section>
</footer>
<div class="podfooter"></div> <!--Нужен для тени в нижней части желтой полосы-->
</body>
</html>
