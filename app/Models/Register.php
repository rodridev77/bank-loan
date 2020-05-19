<?php 

namespace app\Models;

use app\Core\Connection;
use \PDO;

class Register
{
	
	private $conn;
 
    public function __construct() {
        $this->conn = Connection::connect();
    }

    public function signUp($name,$cpf,$pass){
    	try{
    		$query = "INSERT INTO client(name,cpf,pass) VALUES(:name,:cpf,:pass)";
    		$stmt = $this->conn->prepare($query);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $cpf, PDO::PARAM_STR);
            $stmt->bindValue(":pass", md5($pass), PDO::PARAM_STR);
            if($stmt->execute()){
            	return true;
            }
    	}catch (\PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        return false;
    }

}




 ?>