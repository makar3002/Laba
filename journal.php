<?php
	session_start();
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
		require_once ('php/general/header.php');
    ?>
    <main class="pt-5 text-center">
	<?php if (isset($_SESSION['user_id'])) {?>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary p-3" data-toggle="modal" data-target="#modalCreateCenter">
		  Добавить в журнал
		</button>

		<!-- Create Modal -->
		<div class="modal fade" id="modalCreateCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLongTitle">Добавить в журнал</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCreateModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="createForm" enctype="application/x-www-form-urlencoded">
                            <div class="form-group">
                                <label for="number" class="col-form-label">Номер автомобиля:</label>
                                <input type="text" name="number" id="addNumber" class="form-control" placeholder="Номер автомобиля" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="mark" class="col-form-label">Марка автомобиля:</label>
                                <select name="mark" id="addMark" class="form-control mark" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date" class="col-form-label">Дата добавления:</label>
                                <input type="date" name="date" id="addDate" class="form-control" placeholder="Дата добавления" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="buttonAdd">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Modal -->
        <div class="modal fade" id="modalChangeCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLongTitle">Изменить запись в журнале</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeChangeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="changeForm" enctype="application/x-www-form-urlencoded">
                            <div class="form-group">
                                <label for="number" class="col-form-label">Номер автомобиля:</label>
                                <input type="text" name="number" id="changeNumber" class="form-control" placeholder="Номер автомобиля" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="mark" class="col-form-label">Марка автомобиля:</label>
                                <select name="mark" id="changeMark" class="form-control mark" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date" class="col-form-label">Дата добавления:</label>
                                <input type="date" name="date" id="changeDate" class="form-control" placeholder="Дата добавления" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="buttonChange">Изменить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="modalDeleteCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Удалить запись журнала</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeDeleteModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title">Вы уверены, что хотите удалить эту запись?</h5>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-group-lg m-md-auto" id="buttonDeleteYes">Да</button>
                        <button class="btn btn-secondary btn-group-lg m-md-auto" id="buttonDeleteNo">Нет</button>
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
    require_once ('php/general/footer.php');
    ?>
</body>
</html>
