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
	return '<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
    <a class="main-label my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
    <nav class="my-2 my-md-0 mr-md-auto ml-md-auto">
        <a class="p-2 text-light" href="marks.php">Марки</a>
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

function page_auth_header(){
	return '<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
	            <a class="my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
	        </header>';
}

function page_footer()
{
	return '<footer class="page-footer border-top">
	    <section class="copyright">
	        © 2019 Mathfuc
	    </section>
	</footer>
	<div class="podfooter"></div> <!--Нужен для тени в нижней части желтой полосы-->';
}


function is_authorized($if_is_auth, $if_isnt_auth = null){
	if(isset($_SESSION['email']) && isset($_SESSION['user_id'])){
		$email = $_SESSION['email'];
		$user_id = $_SESSION['user_id'];
		return $if_is_auth($email, $user_id);
	}
	else if($if_isnt_auth != null)
		return $if_isnt_auth();
}

function not_auth_text(){
		return '<article class="m-5 entry">
		<h5>Вы не авторизованы, авторизуйтесь, пожалуйста</h5>
			</article>';
}

function page_main($child){
	if($child != null){
		return '<main class="pt-5 text-center">'.$child().'</main>';
	}
	else{
		return '<main class="pt-5 text-center"></main>';
	}
}
?>
