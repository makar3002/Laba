<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
    require_once('php/general/header.php');
    ?>
    <main>
        <article class="entry">
            <section>
                <table class="T">
                    <tr>
                        <td>ФИО</td>
                        <td>Номер телефона</td>
                    </tr>
                    <tr>
                        <td>Люхтенко Н.А</td>
                        <td>xxx-xxx</td>
                    <tr>
                        <td>Макеев Р.В</td>
                        <td>xxx-xxx</td>
                    </tr>
                </table>
            </section>
        </article>
    </main>
    <?php
    require_once('php/general/footer.php');
    ?>
  </body>
</html>