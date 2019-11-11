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
		echo page_header();
		echo page_main(function(){
			return is_authorized(
				function($email, $user_id){
					return
					modal_form().
					data_table($email, $user_id);
				},
				function(){
					return
					not_auth_text();
				}
			);
		});
    echo page_footer();
    ?>
		<script src="js/utils/validate.js" type="text/javascript"></script>
		<script src="js/utils/util.js" type="text/javascript"></script>
		<script src="js/journal/journal.js" type="text/javascript"></script>
		<script src="js/jquery-3.4.1.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
</body>
</html>
