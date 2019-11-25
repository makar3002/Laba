<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/php/general/data.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/php/general/database_connection.php');

class Users extends Data
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
            self::$instance = new Users(DB::getInstance());
        }

        return self::$instance;
    }

    public function create($arr)
    {
        $query = "INSERT INTO 
            users (email, password) 
        VALUES 
            (?, ?)"; //создаем запрос]
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
    }

    public function create_by_vk($arr)
    {
        $query = "INSERT INTO 
            users (email, password) 
        VALUES 
            (?, '')"; //создаем запрос]
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
    }

    public function read_by_email($arr)
    {
        $query = "SELECT
            id, email, password 
        FROM 
            users 
        WHERE 
            email = ?"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
        return $sdh->fetchAll(PDO::FETCH_ASSOC); //получаем данные и фетчим их в ассоциативный массив
    }

    public function read()
    {
        $query = "SELECT
            * 
        FROM 
            users"; //создаем запрос на получение данных
        $sdh = $this->connection->prepare($query);
        $sdh->execute();
        return $sdh->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($arr)
    {
        $query = "UPDATE
            users 
        SET 
            email = ?, password = ?
        WHERE id = ?";
        $sdh = $this->connection->prepare($query);
        $sdh->execute($arr);
    }

    public function delete($id)
    {
        $query = "DELETE FROM 
            users
        WHERE 
            id = ?";
        $sdh = $this->connection->prepare($query);
        return $sdh->execute($id);
    }
}

?>