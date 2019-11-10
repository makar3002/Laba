<?php
	session_start();
	require_once('php/general/header&footer.php');
?>

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
		echo page_header();
		?>
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
    echo page_footer();
    ?>
    </body>
</html>
