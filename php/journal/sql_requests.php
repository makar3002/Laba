<?php
function table_sql_request(PDO $connection, $user_id){
    $query = "SELECT number, brand, date, status FROM cars WHERE user_id = ?"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute(array($user_id));
    return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
}

function add_sql_request(PDO $connection, $user_id, $number, $mark, $date){
    $query = "INSERT INTO cars (user_id, number, brand, date) VALUES (?, ?, ?, ?);"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute(array($user_id, $number, $mark, $date));
}