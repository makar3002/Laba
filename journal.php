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
    require_once('php/general/header.php');
    ?>
    <main>
        <article class="entry">
            <table class="table" align="center">
            <?php
            require_once ('php/journal/user_journal.php');
            ?>
            </table>
        </article>
    </main>
    <?php
    require_once('php/general/footer.php');
    ?>
</body>
</html>