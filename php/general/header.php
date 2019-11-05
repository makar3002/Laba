<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
    <a class="main-label my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
    <nav class="my-2 my-md-0 mr-md-auto ml-md-auto">
        <a class="p-2 text-light" href="marks.php">Марки</a>
        <a class="p-2 text-light" href="owners.php">Владельцы</a>
        <a class="p-2 text-light" href="list_of_security.php">Список сторожей</a>
        <a class="p-2 text-light" href="journal.php">Журнал</a>
    </nav>
    <div class="my-md-0 ml-md-auto d-flex align-items-center">

        <a class="btn btn-sm btn-outline-secondary"
            <?php
            if (!isset($_SESSION['email'])){
                echo "href='auth.php'" ?> > Sign in
            <?php
            } else {
                echo "href='php/general/logout.php'" ?> > Sign out
            <?php
            }
            ?>
        </a>
    </div>
</header>
