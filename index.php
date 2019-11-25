<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Автомобильный гараж</title>
        <meta charset="utf-8">
        <?php
        require_once('php/general/css_and_js_include.php');
        ?>
    </head>
    <body>
    <div id="header">
        <?php
        require_once('php/general/header.php');
        ?>
    </div>
    <main class="pt-5">
        <article class=" d-flex entry">
            <section class="m-3 idea">
                <h2>Автомобильный гараж</h2>
                <h1>У нас только лучшие тачки!</h1>
                <p>Качественный сервис, Экзибит позавидует!</p>
                <p>Охрана и хранение вашей ласточки</p>
                <p>Охрана и хранение вашей ласточки</p>
            </section>
            <section class="m-3 contacts">
                <h1>Контакты: </h1>
                <p>///...///</p>
                <p>///...///</p>
                <p>///...///</p>
            </section>
        </article>

    <section class="photos">
        <figure class="slides">
            <img src="files/images/1.jpg" alt="Машина 1">
            <img src="files/images/2.jpeg" alt="Машина 2">
            <img src="files/images/3.jpg" alt="Машина 3">
            <img src="files/images/4.jpg" alt="Машина 4">
        </figure>
    </section>
    </main>
    <?php
    require_once('php/general/footer.php');
    ?>
    </body>
</html>
