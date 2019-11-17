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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary p-3" data-toggle="modal" data-target="#modalCreateCenter">
                Добавить марку
            </button>

            <!-- Create Modal -->
            <div class="modal fade" id="modalCreateCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Добавить марку</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCreateModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form" id="createForm" enctype="application/x-www-form-urlencoded">
                                <div class="form-group">
                                    <label for = "name" class = "col-form-label">Название марки:</label>
                                    <input type="text" name="name" id="addName" class="form-control" placeholder="Название марки" required autofocus>
                                    <label for = "logo" class = "col-form-label">Логотип марки (картинка в формате png):</label>
                                    <input type="file" name="file" id="addFile" class="form-control-file" required>
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
                            <h5 class="modal-title">Изменить марку</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeChangeModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form" id="changeForm" enctype="application/x-www-form-urlencoded">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Название марки:</label>
                                    <input type="text" name="name" id="changeName" class="form-control" placeholder="Название марки" required autofocus>
                                    <label for="logo" class="col-form-label">Логотип марки (необязательно, если пустое, то картинка останется прежней):</label>
                                    <input type="file" name="file" id="changeFile" class="form-control-file">
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
                            <h5 class="modal-title">Удалить марку</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeDeleteModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title">Вы уверены, что хотите удалить марку?</h5>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger btn-group-lg m-md-auto" id="buttonDeleteYes">Да</button>
                            <button class="btn btn-secondary btn-group-lg m-md-auto" id="buttonDeleteNo">Нет</button>
                        </div>
                    </div>
                </div>
            </div>

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
