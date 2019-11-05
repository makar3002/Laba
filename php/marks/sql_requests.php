<?php
function get_marks_sql_request(PDO $connection){
    $query = "SELECT * FROM marks"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute();
    return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
}

function add_mark_sql_request(PDO $connection, $mark_name){
    $query = "INSERT INTO marks (mark_name) VALUES (?)"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute(array($mark_name));
}
