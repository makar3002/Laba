<?php
require_once ('../general/data.php');
require_once ('../general/database_connection.php');

class Journal
{
    protected static $instanse;
    protected function __construct(){ }
    public static function getInstanse()
    {

        if (empty(self::$instanse))
        {
            self::$instanse = new Journal_singleton(DB::getInstanse());
        }

        return self::$instanse;
    }
}
class Journal_singleton extends Data
{
    private $connection;
    public function __construct($connection){
        $this->connection = $connection;
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

$journal_table = Journal::getInstanse();
?>