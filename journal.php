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
    <main class="pt-5 text-center">
	<?php if (isset($_SESSION['user_id'])) {?>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary p-3" data-toggle="modal" data-target="#exampleModalCenter">
		  Добавить в журнал
		</button>

		<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Добавить в журнал</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <script src="js/utils/validate.js" type="text/javascript"></script>
                        <script src="js/general/ajax_request.js" type="text/javascript"></script>
                        <script src="js/journal/journal.js" type="text/javascript"></script>
                    </div>
                </div>
            </div>
        </div>
		<?php }?>
        <article class="m-5 entry">
            <table class="table" id="table">

            </table>
        </article>
    </main>
    <?php
    require_once('php/general/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
