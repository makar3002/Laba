<?php
function get_marks(PDO $connection){
    $query = "SELECT 
    id, mark_name
FROM 
    marks
ORDER BY
    id"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute();
    return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
}

function add_mark(PDO $connection, $mark_name){
    $query = "INSERT INTO marks (mark_name) VALUES (?)"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute(array($mark_name));
}
