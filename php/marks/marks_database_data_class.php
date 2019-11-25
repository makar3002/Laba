<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/php/general/data.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/php/general/database_connection.php');

//class Marks
//{
//    protected static $instanse;
//    protected function __construct(){ }
//    public static function getInstanse()
//    {
//
//        if (empty(self::$instanse))
//        {
//            self::$instanse = new Marks_singleton(DB::getInstanse());
//        }
//
//        return self::$instanse;
//    }
//}

class Marks extends Data
{
    protected $connection;
    protected static $instance;
    private function __construct($connection){
        $this->connection = $connection;
    }

    public static function getInstance()
    {
        if (empty(self::$instance))
        {
            self::$instance = new Marks(DB::getInstance());
        }

        return self::$instance;
    }

    public function create($arr)
    {
        $query = "INSERT INTO 
            marks (mark_name) 
        VALUES 
            (?)"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
    }

    public function read_by_name($arr)
    {
        $query = "SELECT 
            id, mark_name
        FROM 
            marks
        WHERE 
            mark_name = ?"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
        return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    }

    public function read_by_id($arr)
    {
        $query = "SELECT 
            id, mark_name
        FROM 
            marks
        WHERE 
            id = ?"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
        return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    }

    public function read()
    {
        $query = "SELECT 
            id, mark_name
        FROM 
            marks
        ORDER BY
            id"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute();
        return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    }

    public function update($arr)
    {
        $query = "UPDATE 
            marks 
        SET 
            mark_name = ?
        WHERE id = ? ";
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
    }

    public function delete($id)
    {
        $query = "DELETE FROM 
            marks 
        WHERE 
            id = ?";
        $sdh = $this->connection->prepare($query);
        return $sdh->execute($id);
    }

    public function search($arr)
    {
        if (!empty($arr)) $arr[0] .= '*';

        $query = "SELECT 
            id, mark_name
        FROM 
            marks
        WHERE MATCH mark_name AGAINST (? IN BOOLEAN MODE)";
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
        return $sdh->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>