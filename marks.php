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
<!--    <main>-->
<!--        <article class="m-5 entry">-->
<!--            <h1>Автомобили нашего гаража!</h1>-->
<!--            <section class="cars">-->
<!--                <img align="left" class = "car" src="files/images/logolexus.png" alt="Машина 1">-->
<!--                <p>Лексус</p>-->
<!--            </section>-->
<!--            <section class="cars">-->
<!--                <img align="left" class = "car" src="files/images/logobmw.png" alt="Машина 2">-->
<!--                <p>БМВ</p>-->
<!--            </section>-->
<!--            <section class="cars">-->
<!--                <img align="left" class = "car" src="files/images/logolada.png" alt="Машина 3">-->
<!--                <p>Лада</p>-->
<!--            </section>-->
<!--            <section class="cars">-->
<!--                <img align="left" class = "car" src="files/images/logosuzuki.png" alt="Машина 4">-->
<!--                <p>Suzuki</p>-->
<!--            </section>-->
<!--        </article>-->
<!--    </main>-->
    <main class="pt-5 text-center">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary p-3" data-toggle="modal" data-target="#exampleModalCenter">
            Добавить марку
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Добавить в журнал</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_form">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="form" enctype="application/x-www-form-urlencoded">
                            <div class="form-group">
                                <label for = "Number" class = "col-form-label">Номер Автомобиля:</label>
                                <input type="text" name="number" id="number" class="form-control" placeholder="Номер Автомобиля" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for = "Mark" class = "col-form-label">Марка Автомобиля:</label>
                                <input type="text" name="mark" id="mark" class="form-control" placeholder="Марка автомобиля" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for = "Date" class = "col-form-label">Дата Добавления:</label>
                                <input type="date" name="date" id="date" class="form-control" placeholder="Дата добавления" required autofocus>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="button_add">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <article class="m-5 entry">
            <table class="table" id="table"></table>
        </article>
        <script src="js/utils/validate.js" type="text/javascript"></script>
        <script src="js/utils/util.js" type="text/javascript"></script>
        <script src="js/general/ajax_request.js" type="text/javascript"></script>
        <script src="js/journal/journal.js" type="text/javascript"></script>
    </main>
    <?php
    require_once('php/general/footer.php');
    ?>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php
    require_once('php/general/footer.php');
    ?>
  </body>
</html>
