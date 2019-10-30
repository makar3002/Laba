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
	require_once("php/journal/add_journal.php");

    ?>
    <main>
		<?php if (isset($_SESSION['user_id'])) {?>
		<article class="m-5 p-3 entry">
			<h5>Добавить</h5>
			<form action="journal.php" class="form" method = "post" id = "form">
				<div class="container">
					<div class="row">
						<div class="form-label-group col-sm">
							<input type="text" name="number" id="Number" class="form-control" placeholder="Номер Автомобиля" required autofocus>
						</div>
						<div class="form-label-group col-sm">
							<input type="text" name="mark" id="Mark" class="form-control" placeholder="Марка автомобиля" required autofocus>
						</div>
						<div class="form-label-group col-sm">
							<input type="date" name="date" id="Date" class="form-control" placeholder="Дата добавления" required autofocus>
						</div class="form-label-group col-sm">
                        <button class="btn btn-primary" type="submit">Добавить</button>
                    </div>
                </div>
		    </form>
		    <script src="js/journal.js"></script>
		</article>
		<?php }?>
        <article class="m-5 entry">
            <table class="table">
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
