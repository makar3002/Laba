<?php
session_start();
require_once('../general/connect.php');
$connection = connect('authorization', 'root', '');
if (isset($_SESSION['email']) && isset($_SESSION['user_id']) ) {
    $email = $_SESSION['email'];
    ?>
    <caption style="caption-side: top; padding: 0">
        <h5>Журнал с данными пользователся <?php echo "$email" ?>!</h5>
    </caption>
    <?php
    $user_id = $_SESSION['user_id'];
    $query = "SELECT number, brand, date, status FROM cars WHERE user_id = ?"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute(array($user_id));
    $table = $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    ?>
    <tr>
        <td width="25%">Номер автомобиля</td>
        <td width="25%">Марка</td>
        <td width="25%">Дата принятия</td>
        <td width="25%">Статус</td>
    </tr>
    <?php
    foreach ($table as $r) {
        ?>
        <tr>
            <?php
            foreach ($r as $f) {
                ?>
                <td width="25%"> <?php echo "$f"?> </td>
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
