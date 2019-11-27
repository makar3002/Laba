<?php
class DataBase {
    protected static $instance;
    protected function __construct (){}
    public static function getInstance()
    {
        if (empty($instance))
        {
            $db_info = array(
                'db_host' => 'localhost',
                'db_name' => 'database',
                'db_user' => 'root',
                'db_password' => '');
            try
            {
                self::$instance = new PDO('mysql:host='.$db_info['db_host'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_password']);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }

        }
        return self::$instance;
    }
		public static function Connection(){
			return self::GetInstance();
		}
}
?>
