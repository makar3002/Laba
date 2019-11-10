<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Автомобильный гараж</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.4.1.min.js"></script>
</head>
<body>
    <?php
    session_start();
    require_once('php/general/header.php');
    ?>
    <main>
        <form class="form-signin" id="form" enctype="application/x-www-form-urlencoded">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Антимат</h1>
                <p>Напишите что-нибудь в поле ввода (только культурное)</p>
            </div>
            <div class="form-label-group">
                <input type="text" name="input_text" id="input_text" class="form-control" placeholder="Текст" required autofocus>
            </div>
            <div class = "alert alert-danger" role = "alert" id="polite_text_makarenko">Ваш текст</div>
            <button class="btn btn-lg btn-primary btn-block" id="button_makarenko">Проверить первым способом</button>
            <div class = "alert alert-danger" role = "alert" id="polite_text_zuzin">Ваш текст</div>
            <button class="btn btn-lg btn-primary btn-block" id="button_zuzin">Проверить вторым способом</button>
        </form>
        <script src="js/general/ajax_request.js" type="text/javascript"></script>
        <script src="js/anti_filth/anti_filth.js" type="text/javascript"></script>
    </main>
    <?php
    require_once('php/general/footer.php');
    ?>
</body>
</html>
