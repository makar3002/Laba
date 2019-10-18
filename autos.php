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
    require_once ('php/header.php');
    ?>
    <main>
        <article class="entry">
        <h1>Автомобили нашего гаража!</h1>
        <section class="cars">
            <img align="left"  class = "car" src="images/logolexus.png" alt="Машина 1">
            <p>Лексус</p>
        </section>
        <section class="cars">
            <img align="left" class = "car" src="images/logobmw.png" alt="Машина 2">
            <p>БМВ</p>
        </section>
        <section class="cars">
            <img align="left" class = "car" src="images/logolada.png" alt="Машина 3">
            <p>Лада</p>
        </section>
        <section class="cars">
            <img align="left" class = "car" src="images/logosuzuki.png" alt="Машина 4">
            <p>Suzuki</p>
        </section>
        </article>
    </main>
    <?php
    require_once ('php/footer.php');
    ?>
  </body>
</html>
