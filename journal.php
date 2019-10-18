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
    require_once ('php/header.php');
    ?>
    <main>

        <article class="entry">
            <table class="table" align="center">
            <?php
            require ('php/connect.php');
            $connection = connect('authorization');
            include ('php/check_format.php');
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                ?>
                <h5>Журнал с данными пользователся <?php echo "$email" ?>!</h5>
                <?php
                $query = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_row($result);
                $user_id = $row[0];
                $query = "SELECT number, brand, date FROM cars WHERE user_id = '$user_id'";
                $result = mysqli_query($connection, $query);
                $table = mysqli_fetch_all($result);
                ?>
                <tr>
                    <td>Номер автомобиля</td>
                    <td>Марка</td>
                    <td>Дата принятия</td>
                </tr>
                <?php
                foreach ($table as $r) {
                    ?>
                    <tr>
                        <?php
                        foreach ($r as $f) {
                            ?>
                            <td> <?php echo "$f"?> </td>
                            <?php
                        }
                    ?>
                    </tr>
                <?php
                }
            } else {
                ?>
                <h5>Вы не авторизованы, авторизуйтесь, пожалуйста</h5>
                <?php
            }
            ?>
            </table>
        </article>
    </main>
    <?php
    require_once ('php/footer.php');
    ?>
</body>
</html>