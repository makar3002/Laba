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
		    <a class="main-label my-0 mr-md-auto font-weight-normal text-light" href = "main.php">ГаражQ</a>
		    <nav class="my-2 my-md-0 mr-md-auto ml-md-auto">
		        <a class="p-2 text-light" href="#">Марки</a>
		        <a class="p-2 text-light" href="#">Владельцы</a>
		        <a class="p-2 text-light" href="#">Список сторожей</a>
		        <a class="p-2 text-light" href="#">Журнал</a>
						<a class="p-2 text-light" href="#" id="magic_button">Магическая кнопочка, которая показывает печеньки</a>
		    </nav>
				<div class="my-md-0 ml-md-auto d-flex align-items-center" id="header_buttons"></div>
			</header>
			<div id="forModalForm"></div>
			<main class="pt-5">
					<article class=" d-flex entry">
							<section class="m-3 idea">
									<h2>Автомобильный гараж</h2>
									<h1>У нас только лучшие тачки!</h1>
									<p>Качественный сервис, Экзибит позавидует!</p>
									<p>Охрана и хранение вашей ласточки</p>
									<p>Охрана и хранение вашей ласточки</p>
							</section>
							<section class="m-3 contacts">
									<h1>Контакты: </h1>
									<p>///...///</p>
									<p>///...///</p>
									<p>///...///</p>
							</section>
					</article>
				<section class="photos">
						<figure class="slides">
								<img src="images/mainpage/1.jpg" alt="Машина 1">
								<img src="images/mainpage/2.jpeg" alt="Машина 2">
								<img src="images/mainpage/3.jpg" alt="Машина 3">
								<img src="images/mainpage/4.jpg" alt="Машина 4">
						</figure>
				</section>
			</main>
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
