<?php
require_once('php/general/connect.php');
$connection = connect('authorization');
include_once('php/auth/check_format.php');
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    ?>
    <h5>Журнал с данными пользователся <?php echo "$email" ?>!</h5>
    <?php
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_row($result);
    $user_id = $row[0];
    $query = "SELECT number, brand, date, status FROM cars WHERE user_id = '$user_id'";
    $result = mysqli_query($connection, $query);
    $table = mysqli_fetch_all($result);
    ?>
    <tr>
        <td>Номер автомобиля</td>
        <td>Марка</td>
        <td>Дата принятия</td>
        <td>Статус</td>
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
