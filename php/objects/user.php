<?php

require_once 'config/database.php';

class User{
	public $id;
	public $firstName;
	public $lastName;
	public $nickname;
	public $email;
	public $password;

	public function __construct($data){
		//Используем !empty вместо isset потому что переменные могут не существовать
		$this->id = (!empty($data->id)) ? $data->id : '';
		$this->firstName = (!empty($data->firstName)) ? $data->firstName : '';
		$this->lastName = (!empty($data->lastName)) ? $data->lastName : '';
		$this->nickname = (!empty($data->nickname)) ? $data->nickname : '';
		$this->email = (!empty($data->email)) ? $data->email : '';
		$this->password =(!empty($data->password)) ? $data->password : '';
	}
	public function create(){
		if(!(isset($this->email) || isset($this->nickname)) && !isset($this->password)){
			return false;
		}
		$query = "INSERT INTO users SET
							firstName = ?,
							lastName = ?,
							nickname = ?,
							email = ?,
							password = ?";
		$stmt = DataBase::Connection()->prepare($query);
		$passwordPrepared = password_hash($this->password, PASSWORD_BCRYPT);
		if($stmt->execute(array($this->firstName, $this->lastName, $this->nickname, $this->email, $passwordPrepared)))
			return true;
		else{
			return false;
		}
	}
	public function read(){
		if(isset($this->email)){
			$query = "SELECT * FROM users WHERE email = 'me@mail.ru';";
			$stmt = DataBase::Connection()->prepare($query);
			//$stmt->execute(array($this->email));
			$stmt->execute();
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
			if($stmt->rowCount() > 0){
				if(password_verify($this->password, $row["password"])){
					$this->firstName = $row["firstName"];
					$this->lastName = $row["lastName"];
					$this->nickname = $row["nickname"];
					return true;
				}
				else{
					echo "NOVALID";
					return false;
				}
			}
			else{
				echo $stmt->rowCount();
				echo $this->email;
				echo "NOMATCH";
				return false;
			}
		}
		if(isset($this->nickname)){
			$query = "SELECT id,firstName, lastName, email, password FROM 'users' WHERE nickname = ? LIMIT 0,1";
			$stmt = DataBase::Connection()->prepare($query);
			$stmt->execute(array($this->nickname));
			if($stmt->rowCount() > 0){
				$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
				if(password_verify($this->password, $row['password'])){
					$this->firstName = $row['firstName'];
					$this->lastName = $row['lastName'];
					$this->email = $row['email'];
					return true;
				}
				else
					return false;
			}
			else
				return false;
		}
		return false;
	}
	public function update($data){
		//Мы можем изменять только не уникальные поля
		//В данном случае, firstName, lastName
		$query = "UPDATE 'users' SET firstName = ?, lastName = ?";
		$stmt = DataBase::Connection()->prepare($query);
		if($stmt->execute(array($data->firstName, $data->lastName))){
			$this->firstName = $data->firstName;
			$this->lastName = $data->lastName;
			return true;
		}
		else
			return false;
	}
}
?>
