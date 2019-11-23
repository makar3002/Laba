<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Автомобильный гараж</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
require_once('php/general/header.php');
?>
<main class="pt-5 text-center">
    <div id="table">

    </div>

    <div id="search">

    </div>

    <script src="js/utils/validate.js" type="text/javascript"></script>
    <script src="js/utils/util.js" type="text/javascript"></script>
    <script src="js/general/ajax_request.js" type="text/javascript"></script>
    <script src="js/marks/marks.js" type="text/javascript"></script>
</main>
<?php
require_once('php/general/footer.php');
?>
</body>
</html>
