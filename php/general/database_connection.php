<?php
class DB {
    protected static $instanse;
    protected function __construct (){}
    public static function getInstanse()
    {
        if (empty($instanse))
        {
            $db_info = array(
                'db_host' => 'localhost',
                'db_name' => 'database',
                'db_user' => 'root',
                'db_password' => '');

            try
            {
                self::$instanse = new PDO('mysql:host='.$db_info['db_host'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_password']);
                self::$instanse->query('SET NAMES utf8');
                self::$instanse->query('SET CHARACTER SET utf8');

            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }

        }

        return self::$instanse;
    }
}

$connection = DB::getInstanse();
?>
