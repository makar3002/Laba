<?php
function connect($database)
{
    $connection = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($connection, $database);
    return $connection;
}
?>
