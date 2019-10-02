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
        <h5 class="my-0 mr-md-auto font-weight-normal text-light">ГаражQ</h5>
        <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-light" href="autos.html">Автомобили</a>
        <a class="p-2 text-light" href="owners.html">Владельцы</a>
        <a class="p-2 text-light" href="#">Список сторожей</a>
            <?php
            if (!isset($_SESSION['email'])){
                ?>
                <a class="p-2 text-light" <?php echo 'href="#"' ?> > Журнал</a>
                <?php
            } else {
                ?>
                <a class="p-2 text-light" <?php echo 'href="journal.php"' ?> > Журнал</a>
                <?php
            }
            ?>
        </nav>
        <div class="col-4 d-flex justify-content-end align-items-center">
            <?php
            if (!isset($_SESSION['email'])){
                ?>
                <a class="btn btn-sm btn-outline-secondary " <?php echo "href='auth.php'" ?> > Sign up</a>
                <?php
            } else {
                ?>
                <a class="btn btn-sm btn-outline-secondary " <?php echo "href='php/logout.php'" ?> > Sign out</a>
                <?php
            }
            ?>
        </div>
    </header>
    <main>
      <article class="entry">
        <section class="idea">
          <h2>Автомобильный гараж</h2>
          <h1>У нас только лучшие тачки!</h1>
          <p>Качественный сервис, Экзибит позавидует!</p>
          <p>Охрана и хранение вашей ласточки</p>
          <p>Охрана и хранение вашей ласточки</p>
        </section>
        <section class="contacts">
          <h1>Контакты: </h1>
          <p>///...///</p>
          <p>///...///</p>
          <p>///...///</p>

        </section>

      </article>

    <section class="photos">
      <figure class="slides">
        <img src="images/1.jpg" alt="Машина 1">
        <img src="images/2.jpeg" alt="Машина 2">
        <img src="images/3.jpg" alt="Машина 3">
        <img src="images/4.jpg" alt="Машина 4">
      </figure>
    </section>
    </main>
    <footer class="border-top page-footer border-top">
      <section class="copyright">
        © 2019 Mathfuc
      </section>
    </footer>
    <div class="podfooter"></div>
    </body>
</html>