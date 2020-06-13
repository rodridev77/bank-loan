<?php declare(strict_types=1);

namespace app\Models;

use app\Core\Connection;
use \PDO;
use \PDOException;

class AdminAuth {
    private int $managerId;
    private string $token;
    private ?PDO $conn;

    public function __construct() {
        $this->conn = Connection::connect();
    }

    public function validateAuth(Manager $manager) : bool {

        try {
            $query = "SELECT id FROM manager WHERE cpf = :cpf AND pass = :pass";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":cpf", $manager->getCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":pass", $manager->getPass(), PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->managerId = intval($stmt->fetch(PDO::FETCH_OBJ)->id);
                $stmt->closeCursor();

                if ($this->setToken($this->managerId)):
                    return true;
                endif;

                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function setToken(int $id) : bool {
        try {

            $this->token = md5(time() . rand(0, 99999) . $id);

            $query = "UPDATE manager SET token = :token WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":token", $this->token, PDO::PARAM_STR);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()):
                $stmt->closeCursor();
                return true;
            endif;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }
    
    public function getManageManagerId() : int {
        return $this->managerId;
    }
    
    public function getManageToken() : string {
        return $this->token;
    }

}