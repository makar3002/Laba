<?php
function connect($database, $user, $password)
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
