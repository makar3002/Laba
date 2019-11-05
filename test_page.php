<?php
	session_start();
	require_once('php/general/header&footer.php');
	require_once('php/test_page/main.php');
?>

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
		page_header();
    ?>

		<main class="pt-5 text-center">
		<?php
		if (isset($_SESSION['email']) && isset($_SESSION['user_id'])){
			$email = $_SESSION['email'];
			$user_id = $_SESSION['user_id'];
			modal_form();
			data_table($email, $user_id);
		}
		else {
			echo '<article class="m-5 entry">
			<h5>Вы не авторизованы, авторизуйтесь, пожалуйста</h5>
				</article>';
		}
		?>

		</main>

		<?php
    page_footer();
    ?>

		<script src="js/jquery-3.4.1.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
</body>
</html>
