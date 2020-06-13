<?php 
namespace app\Models;

use app\Core\Connection;
use \PDO;

class Log{

    private ?PDO $conn;
    private int $id;

    public function __construct() 
    {
        $this->conn = Connection::connect();
    }

    public function firstAccess($fkeys) : bool {
        $fkeyIndex = array_keys($fkeys);
        $fkeyIndex = array_shift($fkeyIndex);
        $fkeyValue = array_values($fkeys);
        $fkeyValue = array_shift($fkeyValue);

        $query = "INSERT INTO log ($fkeyIndex) VALUES (:".$fkeyIndex.")";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":$fkeyIndex", $fkeyValue, PDO::PARAM_INT);

        if  ($stmt->execute()) :
            $this->id = $this->conn->lastInsertId();
            return true;
        endif;

        return false;
    }

    public function lastAccess($id, $fkeys) : bool {
        $fkeyIndex = array_keys($fkeys);
        $fkeyIndex = array_shift($fkeyIndex);
        $fkeyValue = array_values($fkeys);
        $fkeyValue = array_shift($fkeyValue);

        $date = date("Y-m-d H:i:s");

        $query = "UPDATE log SET last_access = :last_access WHERE id = :id AND $fkeyIndex = :".$fkeyIndex;
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":last_access", $date, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->bindValue(":$fkeyIndex", $fkeyValue, PDO::PARAM_INT);

        if  ($stmt->execute()) :
            return true;
        endif;

        return false;
    }

    public function getId() : int {
        return $this->id ?? 0;
    }
}