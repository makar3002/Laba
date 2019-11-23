<?php
require_once ('../general/data.php');
require_once ('../general/database_connection.php');

class Journal extends Data
{
    protected $connection;
    protected static $instance;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public static function getInstance()
    {

        if (empty(self::$instance))
        {
            self::$instance = new Journal(DB::getInstance());
        }

        return self::$instance;
    }

    public function create($arr)
    {
        $query = "INSERT INTO 
            journal_notes (user_id, number, mark_id, date) 
        VALUES 
            (?, ?, ?, ?)"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
    }

    public function read_by_id($arr)
    {
        $query = "SELECT
            id, user_id, number, mark_id, date
        FROM
            journal_notes
        WHERE
            id = ?"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
        return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    }

    public function read_by_mark_id_and_user_id($arr)
    {
        $query = "SELECT
            journal_notes.id, number, mark_name, date, status
        FROM
            journal_notes
        INNER JOIN marks ON journal_notes.mark_id = marks.id
        WHERE
            journal_notes.mark_id = ? AND journal_notes.user_id = ?
        ORDER BY
            date"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
        return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    }

    public function read_by_user_id($arr)
    {
        $query = "SELECT
            journal_notes.id, number, mark_name, date, status
        FROM
            journal_notes
        INNER JOIN marks ON journal_notes.mark_id = marks.id
        WHERE
            user_id = ?
        ORDER BY
            date"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
        return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    }

    public function read()
    {
        $query = "SELECT
            number, mark_name, date, status
        FROM
            journal_notes
        INNER JOIN marks ON journal_notes.mark_id = marks.id
        ORDER BY
            date"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute();
        return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    }

    public function update($arr)
    {
        $query = "UPDATE
            journal_notes 
        SET 
            number = ?, mark_id = ?, date = ?
        WHERE id = ?";
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
    }

    public function delete($id)
    {
        $query = "DELETE FROM 
            journal_notes 
        WHERE 
            id = ?";
        $sdh = $this->connection->prepare($query);
        return $sdh->execute($id);
    }
}

?>