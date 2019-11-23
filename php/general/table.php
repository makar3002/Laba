<?php
abstract class Table
{
    abstract public function add($arr);
    abstract public function get_table($arr);
    abstract public function change($arr);
    abstract public function delete($arr);
    public $db; //В формате PDO
}
?>
