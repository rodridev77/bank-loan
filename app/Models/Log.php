<?php 
namespace app\Models;

use app\Core\Connection;
use \PDO;

class Log{

    private $conn;

    public function __construct()
    {
        $this->conn = Connection::connect();
    }

    public function firstAccessLog($id = null, $manager_id = null){
        $query = "INSERT INTO log(client_id,manager_id) VALUES(:client_id,:manager_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":client_id",$id, PDO::PARAM_INT);
        $stmt->bindValue(":manager_id",$manager_id, PDO::PARAM_INT);
        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function lastAccessLog($id){
        $date = date("Y-m-d H:i:s");
        $query = "UPDATE log SET last_access = :last_access WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        $stmt->bindValue(":last_access",$date, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }


}