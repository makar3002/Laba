<?php
 require_once("connect.php");
abstract class _data
{
  abstract public function create();
  abstract static public function read($obj, $id);
  abstract public function update();
  abstract public function delete();
  public $value; //Ассоциативный массив в котором хранятся данные
}

class journal_data extends _data
{
  public function create()
  {
		$str = "INSERT INTO cars (user_id, number, brand, date) VALUES (?, ?, ?, ?) ;";
  	$request = DBConnection::GetConnection()->prepare($str);
		return $request->execute(array($value['user_id'], $value['number'], $value['brand'], $value['date']));
	}
	public static function read($obj, $id)
	{
		$str = "SELECT (id, user_id, number, brand, date, status) FROM cars WHERE 'id' = ? ;";
		$request = $DBConnection::GetConnection()->prepare($str);
		$request->execute(array($id));
		$obj->value = $request->fetch(PDO::FETCH_ASSOC);
	}
	public function update()
	{
		$str = "UPDATE cars SET user_id = ?, number = ?, brand = ?, date = ? WHERE id = ? ;";
		$request = DBConnection::GetConnection()->prepare($str);
		return $request->execute(array($value['user_id'], $value['number'], $value['brand'], $value['date'], $value['id']));
	}

	public function delete()
	{
		$str = "DELETE FROM cars WHERE id = ? ;";
		$request = DBConnection::GetConnection()->prepare($str);
		return $request->execute($value['id']);
	}

	public function __construct($arr)
	{
		$this->value  = array('user_id' => $arr['user_id'], 'number' => $arr['number'], 'mark_name' => $arr['mark_name'], 'date' => $arr['date'],
						'status' => $arr['status']);
		return $this;
	}
}


function get_journal_data_from_db($user_id)
{
 	$str =
 	"SELECT
 		number, mark_name, date, status, user_id
	FROM
		journal_notes
	INNER JOIN marks ON journal_notes.mark_id = marks.id
	WHERE user_id = ?
 	ORDER BY -date;";
 	$request = DBConnection::GetConnection()->prepare($str);
 	$request->execute(array($user_id));

 	$table_data = $request->fetchAll(PDO::FETCH_ASSOC);
 	$end_arr = [];
 	foreach ($table_data as $table_data_part) {
 		array_push($end_arr,new journal_data($table_data_part));
 	}
 	return $end_arr;
}
 ?>
