<?php
function page_header(){
	if (!isset($_SESSION['email']))
	{
		$signing = " href='auth.php'> Sign in";
	}
	else
	{
		$signing = " href='php/general/logout.php'> Sign out";
	};
	echo '<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
    <a class="main-label my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
    <nav class="my-2 my-md-0 mr-md-auto ml-md-auto">
        <a class="p-2 text-light" href="autos.php">Автомобили</a>
        <a class="p-2 text-light" href="owners.php">Владельцы</a>
        <a class="p-2 text-light" href="list_of_security.php">Список сторожей</a>
        <a class="p-2 text-light" href="journal.php">Журнал</a>
				<a class="p-2 text-light" href="test_page.php">Тестовая стр для всякой гадости</a>
    </nav>
    <div class="my-md-0 ml-md-auto d-flex align-items-center">
        <a class="btn btn-sm btn-outline-secondary"'.$signing.'
        </a>
    </div>
		</header>';
}

function page_footer()
{
	echo '<footer class="page-footer border-top">
	    <section class="copyright">
	        © 2019 Mathfuc
	    </section>
	</footer>
	<div class="podfooter"></div> <!--Нужен для тени в нижней части желтой полосы-->';
}
?>
