<?php
session_start();
require_once('../general/connect.php');
$connection = connect('authorization', 'root', '');
if (isset($_SESSION['email']) && isset($_SESSION['user_id']) ) {
    $email = $_SESSION['email'];
    ?>
    <caption>
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
        <td width="7%">№</td>
        <td width="22%">Номер автомобиля</td>
        <td width="22%">Марка</td>
        <td width="22%">Дата принятия</td>
        <td width="9%">Статус</td>
        <td width="9%">Изменить</td>
        <td width="9%">Удалить</td>
    </tr>
    <?php
    for ($i = 1; $i <= count($table); $i++) {
        $r = $table[$i-1];
        ?>
        <tr>
            <td width="7%"> <?php echo "$i"; ?> </td>
            <?php
            $j = 0;
            foreach ($r as $f) {
                if ($j == count($r) - 1) {
                    ?>
                    <td width="11%"> <?php echo "$f"?> </td>
                    <?php
                } else {
                ?>
                <td width="22%"> <?php echo "$f"?> </td>
                <?php
                }
                $j++;
            }
            ?>
            <td width="8%">Изменить</td>
            <td width="8%">Удалить</td>
        </tr>
        <?php
    }
} else {
    ?>
    <h5>Вы не авторизованы, авторизуйтесь, пожалуйста</h5>
    <?php
}
?>
