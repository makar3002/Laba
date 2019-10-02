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
  ?>
  <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 border-bottom page-header">
      <a class="main-label my-0 mr-md-auto font-weight-normal text-light" href = "index.php">ГаражQ</a>
      <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-light" href="autos.php">Автомобили</a>
          <a class="p-2 text-light" href="owners.php">Владельцы</a>
          <a class="p-2 text-light" href="#">Список сторожей</a>
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
    <main>
      <article class="entry">
        <h1>Автомобили нашего гаража!</h1>
        <section class="cars">
          <img align="left"  class = "car" src="images/logolexus.png" alt="Машина 1">
          <p>Лексус</p>
        </section>
        <section class="cars">
          <img align="left" class = "car" src="images/logobmw.png" alt="Машина 2">
          <p>БМВ</p>
        </section>
        <section class="cars">
          <img align="left" class = "car" src="images/logolada.png" alt="Машина 3">
          <p>Лада</p>
        </section>
        <section class="cars">
          <img align="left" class = "car" src="images/logosuzuki.png" alt="Машина 4">
          <p>Suzuki</p>
        </section>
      </article>
    </main>

    <footer class="border-top page-footer border-top">
      <section class="copyright">
          © 2019 Mathfuc
      </section>
    </footer>
    <div class="podfooter"></div>
  </body>
</html>
