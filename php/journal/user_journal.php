<?php
require_once('php/general/connect.php');
$connection = connect1('authorization', 'root', '');
if (isset($_SESSION['email']) && isset($_SESSION['user_id']) ) {
    $email = $_SESSION['email'];
    ?>
    <h5>Журнал с данными пользователся <?php echo "$email" ?>!</h5>
    <?php
    $user_id = $_SESSION['user_id'];
    $query = "SELECT number, brand, date, status FROM cars WHERE user_id = ?";
    $sdh = $connection->prepare($query);
    $sdh->execute(array($user_id));
    $table = $sdh->fetchAll(PDO::FETCH_ASSOC);
    foreach ($table[0] as $r) echo 1;
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
