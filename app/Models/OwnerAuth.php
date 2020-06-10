<?php declare(strict_types=1);

namespace app\Models;

use app\Core\Connection;
use \PDO;
use \PDOException;

class OwnerAuth {
    private string $token;
    private ?PDO $conn;

    public function __construct() {
        $this->conn = Connection::connect();
    }

    public function validateAuth(Owner $owner) : bool {

        try {
            $query = "SELECT id, token FROM owner WHERE cpf = :cpf AND pass = :pass AND secret_key = :secret_key";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":cpf", $owner->getCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":pass", $owner->getPass(), PDO::PARAM_STR);
            $stmt->bindValue(":secret_key", $owner->getSecretKey(), PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->setToken($stmt->fetch(PDO::FETCH_OBJ)->token);
                $stmt->closeCursor();
                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function setToken(string $token) : void {
        $this->token = $token;
    }

    public function getToken() : string {
        return $this->token;
    }

}