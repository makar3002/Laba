<?php

$docRoot=$_SERVER['DOCUMENT_ROOT'];
require_once $docRoot.'/php/libs/php-jwt-master/src/BeforeValidException.php';
require_once $docRoot.'/php/libs/php-jwt-master/src/ExpiredException.php';
require_once $docRoot.'/php/libs/php-jwt-master/src/SignatureInvalidException.php';
require_once $docRoot.'/php/libs/php-jwt-master/src/JWT.php';
require_once $docRoot.'/php/config/database.php';
use \Firebase\JWT\JWT;
require_once $docRoot.'/php/config/core.php';

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
			$query = "SELECT * FROM users WHERE email = ?";
			$stmt = DataBase::Connection()->prepare($query);
			$stmt->execute(array($this->email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0){
				if(password_verify($this->password, $row["password"])){
					$this->id = $row["id"];
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
		//В данном случае, firstName, lastName, password
		$stmt_vars = array();
		$password_hash = "";
		$query = "UPDATE 'users' SET";
		if(!empty($data->firstName)){
			$query.=" firstName = ?";
			array_push($stmt_vars, $data->firstName);
		}

		if(!empty($data->lastName)){
			if(count($stmt_vars) > 0)
				$query.=",";
			$query.=" lastName = ?";
			array_push($stmt_vars, $data->lastName);
		}

		if(!empty($data->password)){
			if(count($stmt_vars) > 0)
				$query.=",";
			$query.=" password = ?";
			$password_hash = password_hash($data->password);
			array_push($stmt_vars, $password_hash);
		}

		if(count($stmt_vars) == 0)
			return false;

		$query.="WHERE id = ?";
		$stmt = DataBase::Connection()->prepare($query);
		
		array_push($stmt_vars, $this->id);
		if($stmt->execute($stmt_vars)){
			if(!empty($data->firstName))
				$this->firstName = $data->firstName;
			if(!empty($data->lastName))
				$this->lastName = $data->lastName;
			
			if(!empty($password_hash))
				$this->password = $password_hash;
			return true;
		}
		else
			return false;
	}

	public function generateToken($key){
		global $iss;
		global $aud;
		global $iat;
		global $nbf;

		$token = array(
	       "iss" => $iss,
	       "aud" => $aud,
	       "iat" => $iat,
	       "nbf" => $nbf,
	       "data" => array(
	        	"id" => $this->id,
	        	"firstName" => $this->firstName,
	        	"lastName" => $this->lastName,
				"nickname" => $this->nickname,
	        	"email" => $this->email
	       )
	    );

		// создание jwt
	    $jwt = JWT::encode($token, $key);
	    return $jwt;
	}
}

?>
