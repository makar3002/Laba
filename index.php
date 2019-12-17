<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>ГаражQ</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.css">
		<style>
      		.bd-placeholder-img {
				font-size: 1.125rem;
                text-anchor: middle;
                filter: blur(3px);
			}

			@media (min-width: 768px) {
				.bd-placeholder-img-lg {
				font-size: 3.5rem;
				}
            }
            /* Sticky footer styles
            -------------------------------------------------- */
            html {
                position: relative;
                min-height: 100%;
            }
            body {
                margin-bottom: 60px; /* Margin bottom by footer height */
            }
            .footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 60px; /* Set the fixed height of the footer here */
                line-height: 60px; /* Vertically center the text there */
            }
            .content{
                padding: 4rem 2rem;
            }

            #journalTable{
                border: 0.1rem dashed #82beff;
                border-radius: 30px;
            }

    	</style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" id="index" href="#">ГаражQ</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <!--
                    <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    -->
                    <li class="nav-item">
                    <a class="nav-link"  href="#">Марки</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Владельцы</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="journal" href="#">Журнал</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#" id="magic_button">Cookie</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#" id="MB2">Another MB</a>
                    </li>
                    <li>
                        <form class="form-inline mt-2 mt-md-0">
                            <input class="form-control mr-sm-2 mx-2" type="text" placeholder="Поиск" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" type="submit">Поиск</button>
                        </form>
                    </li>
                </ul>
                
                <span id="header_buttons"></div>
                </div>
            </nav>
        </header>
        <div id="forModalForm">
			<div id="modalFormHeader"></div>
			<div id="modalFormMain"></div>
		</div>
        <main>
        
        </main>
        <hr>
        <footer class="footer text-right">
            <div class="container">
                <span class="text-muted ">&copy; 2019 Mathfuc</span>
            </div>
        </footer>

        <script src="js/config/jquery-3.4.1.min.js"></script>
	    <script src="js/config/popper.min.js"></script>
	    <script src="js/config/bootstrap.min.js"></script>
	    <script src="js/config/jquery.cookie.js" type="text/javascript"></script>
	    <script src="js/main_script.js" type="text/javascript"></script>
    </body>
    
</html>