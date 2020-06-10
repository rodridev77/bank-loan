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

    public function firstAccessLog($fks = array()){
        $fkeyIndex = array_keys($fks);
        $fkeyIndex = array_shift($fkeyIndex);
        $fkeyValue = array_values($fks);
        $fkeyValue = array_shift($fkeyValue);
        $query = "INSERT INTO log($fkeyIndex) VALUES(:".$fkeyIndex.")";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":$fkeyIndex",$fkeyValue, PDO::PARAM_INT);
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