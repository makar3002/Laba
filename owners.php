<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Автомобильный гараж</title>
    <meta charset="utf8">
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
    <main>
        <article class="m-5 entry">
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