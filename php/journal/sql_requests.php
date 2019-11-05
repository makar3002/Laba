<?php
function get_journal_sql_request(PDO $connection, $user_id){
    $query = "SELECT number, mark_id, date, status FROM journal_notes WHERE user_id = ?"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute(array($user_id));
    return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
}

function add_journal_note_sql_request(PDO $connection, $user_id, $number, $mark, $date){
    $query = "INSERT INTO journal_notes (user_id, number, mark_id, date) VALUES (?, ?, ?, ?);"; //создаем запрос на получение данных
    $sdh = $connection->prepare($query);
    $sdh->execute(array($user_id, $number, $mark, $date));
}
