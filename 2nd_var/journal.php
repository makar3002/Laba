<?php
	session_start();
	require_once('php/general/header&footer.php');
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Автомобильный гараж</title>
    <meta charset="utf8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php
		echo page_header();
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_form">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="form" enctype="application/x-www-form-urlencoded">
                            <div class="form-group">
                                <label for = "number" class = "col-form-label">Номер Автомобиля:</label>
                                <input type="text" name="number" id="number" class="form-control" placeholder="Номер Автомобиля" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for = "mark" class = "col-form-label">Марка Автомобиля:</label>
                                <select name="mark" id="mark" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for = "date" class = "col-form-label">Дата Добавления:</label>
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
		<?php }?>
        <article class="m-5 entry">
            <table class="table" id="table"></table>
        </article>
        <script src="js/utils/validate.js" type="text/javascript"></script>
        <script src="js/utils/util.js" type="text/javascript"></script>
        <script src="js/general/ajax_request.js" type="text/javascript"></script>
        <script src="js/journal/journal.js" type="text/javascript"></script>
    </main>
    <?php
    echo page_footer();
    ?>
</body>
</html>
