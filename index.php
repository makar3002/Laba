<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Автомобильный гараж</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
		<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
	    	<a class="main-label my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
	    	<nav class="my-2 my-md-0 mr-md-auto ml-md-auto">
	    	    <a class="p-2 text-light" href="#">Марки</a>
	        	<a class="p-2 text-light" href="#">Владельцы</a>
	        	<a class="p-2 text-light" href="#">Список сторожей</a>
	        	<a class="p-2 text-light" href="#">Журнал</a>
				<a class="p-2 text-light" href="#" id="magic_button">Магическая кнопочка, которая показывает печеньки</a>
	    	</nav>
			<div class="my-md-0 ml-md-auto d-flex align-items-center" id="header_buttons"></div>
		</header>
		
		<div id="forModalForm">
			<div id="modalFormHeader"></div>
			<div id="modalFormMain"></div>
		</div>
		
		<main class="pt-5"> </main>
		
		<footer class="page-footer border-top">
		    <section class="copyright">
		        © 2019 Mathfuc
		    </section>
		</footer>
		<div class="podfooter"></div>
		<!--Нужен для тени в нижней части желтой полосы-->
		<script src="js/config/jquery-3.4.1.min.js"></script>
	   	<script src="js/config/popper.min.js"></script>
	   	<script src="js/config/bootstrap.min.js"></script>
		<script src="js/config/jquery.cookie.js" type="text/javascript"></script>
		<script src="js/main_script.js" type="text/javascript"></script>
	</body>
</html>
