<?php 
$docRoot=$_SERVER['DOCUMENT_ROOT'];
require_once $docRoot.'/php/config/database.php';


class JournalNote{
	public $id;
	public $user_id;
	public $number;
	public $mark_id;
	public $date;
	public $status;

	public function __construct($data){
		//Используем !empty вместо isset потому что переменные могут не существовать
		$this->id = (!empty($data->id)) ? $data->id : '';
		$this->user_id = (!empty($data->user_id)) ? $data->user_id : '';
		$this->number = (!empty($data->number)) ? $data->number : '';
		$this->mark_id = (!empty($data->mark_id)) ? $data->mark_id : '';
		$this->date = (!empty($data->date)) ? $data->date : '';
		$this->status = (!empty($data->status)) ? $data->status : '';	
	}

	public function create(){
		if(!isset($this->user_id) || !isset($this->number) || !isset($this->mark_id))
			return false;
		$query = "INSERT INTO journal_notes SET
						user_id = ?,
						number = ?,
						mark_id = ?,
						date = ?";
		$stmt = DataBase::Connection()->prepare($query);
		if($stmt->execute(array($this->user_id, $this->number, $this->mark_id, $this->date)))
			return true;
		else{
			return false;
		}
	}

	public function read(){
		if(!isset($this->id))
			return false;
		$query = "SELECT * FROM journal_notes WHERE id = ? AND user_id = ?";
		$stmt = DataBase::Connection()->prepare($query);
		$stmt->execute(array($this->id, $this->user_id));
		if($stmt->rowCount() > 0){
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$this->number = $row['number'];
			$this->mark_id = $row['mark_id'];
			$this->date = $row['date'];
			$this->status = $row['status'];
			return true;
		}
		else
			return false;
	}

	public function update($data){

		//Мы можем изменять только не уникальные поля
		//В данном случае, number, mark_id, date, status

		$query = "UPDATE 'journal_notes' SET number = ?, mark_id = ?, date = ?, status = ? WHERE id = ?";
		$stmt = DataBase::Connection()->prepare($query);
		$stmt_vars = array();
		array_push($stmt_vars, !empty($data->number) ? $data->number : $this->number);
		array_push($stmt_vars, !empty($data->mark_id) ? $data->mark_id : $this->mark_id);
		array_push($stmt_vars, !empty($data->date) ? $data->date : $this->date);
		array_push($stmt_vars, !empty($data->status) ? $data->status : $this->status);
		array_push($stmt_vars, $this->id);

		if($stmt->execute(array($data->number, $data->mark_id, $data->date, $data->status))){
			$this->number = !empty($data->number) ? $data->number : $this->number;
			$this->mark_id = !empty($data->mark_id) ? $data->mark_id : $this->mark_id;
			$this->date = !empty($data->date) ? $data->date : $this->date;
			$this->status = !empty($data->status) ? $data->status : $this->status;
			return true;
		}
		else
			return false;
	}

	public function delete(){
		//Удаляем по ключу id
		$query = "DELETE FROM journal_notes WHERE id = ?"
		$stmt = DataBase::Connection()->prepare($query);
		if($stmt->execute(array($this->id)))
			return true;
		else
			return false;
	}

}

?>