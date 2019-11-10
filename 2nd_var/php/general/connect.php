<?php
function connect1($database)
{
    $connection = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($connection, $database);
    return $connection;
}
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

class DBConnection
{
		private static $instance;
		public static function GetInstance() {    // Возвращает единственный экземпляр класса. @return Singleton
			 if ( empty(self::$instance) ) {
					 self::$instance = new self();
			 }
			 return self::$instance;
	 	}
		private $db_con;
	 	private function __construct()
	 	{
		 	$this->db_con = new PDO('mysql:dbname=database;host:localhost', 'root', '');
			return $this;
		}

		public function GetConnection()
		{
			return self::GetInstance()->db_con;
		}

	 	private function __clone() {}
  	private function __wakeup() {}
}
?>
