<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
    <a class="main-label my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-light" href="autos.php">Автомобили</a>
        <a class="p-2 text-light" href="owners.php">Владельцы</a>
        <a class="p-2 text-light" href="list_of_security.php">Список сторожей</a>
        <a class="p-2 text-light" href="journal.php">Журнал</a>
    </nav>
    <div class="col-4 d-flex justify-content-end align-items-center">

        <a class="btn btn-sm btn-outline-secondary"
            <?php
            if (!isset($_SESSION['email'])){
            echo "href='auth.php'" ?> > Sign in</a>
        <?php
        } else {
            echo "href='php/logout.php'" ?> > Sign out</a>
            <?php
        }
        ?>
    </div>
</header>
