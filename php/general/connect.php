<?php
function connect($database)
{
    $connection = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($connection, $database);
    return $connection;
}
function connect1($database, $user, $password)
{
    $dsn = 'mysql:dbname='.$database.';host:localhost';
    try {

        $connection = new PDO($dsn, $user, $password);
        return $connection;

    } catch (PDOException $e){
        return null;
    }
}
?>
