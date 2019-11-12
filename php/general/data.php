<?php
 require_once("connect.php");
abstract class _data
{
  abstract public function create();
  abstract static public function read($obj, $id);
  abstract public function update();
  abstract public function delete();
  public $value; //Ассоциативный массив в котором хранятся данные
  public $db; //В формате PDO
}

class journal_data extends _data
{
  public function create()
  {
		$str = "INSERT INTO cars (user_id, number, brand, date) VALUES (?, ?, ?, ?) ;";
  	$request = $db->prepare($str);
		return $request->execute(array($value['user_id'], $value['number'], $value['brand'], $value['date']));
	}
	public static function read($obj, $id)
	{
		$str = "SELECT (id, user_id, number, brand, date, status) FROM cars WHERE 'id' = ? ;";
		$request = $db->prepare($str);
		$request->execute(array($id));
		$obj->value = $request->fetch(PDO::FETCH_ASSOC);
	}
	public function update()
	{
		$str = "UPDATE cars SET user_id = ?, number = ?, brand = ?, date = ? WHERE id = ? ;";
		$request = $db->prepare($str);
		return $request->execute(array($value['user_id'], $value['number'], $value['brand'], $value['date'], $value['id']));
	}

	public function delete()
	{
		$str = "DELETE FROM cars WHERE id = ? ;";
		$request = $db->prepare($str);
		return $request->execute($value['id']);
	}

	public function __construct($arr, $database)
	{
		$this->value  = array('id' => $arr['id'], 'user_id' => $arr['user_id'], 'number' => $arr['number'], 'brand' => $arr['brand'], 'date' => $arr['date'],
						'status' => $arr['status']);
		$this->db = $database;
		return $this;
	}
}


function get_journal_data_from_db($db, $user_id)
{
 $str = "SELECT * FROM cars WHERE user_id = ? ORDER BY -date;";
 $request = $db->prepare($str);
 $request->execute(array($user_id));
 $table_data = $request->fetchAll(PDO::FETCH_ASSOC);
 $end_arr = [];
 foreach ($table_data as $table_data_part) {
 	array_push($end_arr,new journal_data($table_data_part,$db));
 }
 return $end_arr;
}

abstract class Data
{
	abstract public function create($arr);
	abstract public function read();
	abstract public function update($arr);
	abstract public function delete($arr);
	public $db; //В формате PDO
}
 ?>
