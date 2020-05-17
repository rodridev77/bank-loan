<?php declare(strict_types=1);

namespace app\Models;

use app\Core\Connection;
use app\Models\Client;
use \PDOException;
use \stdClass;
use \PDO;

class ClientDAO {

    private ?PDO $conn;

    public function __construct() {
        $this->conn = Connection::connect();
    }

    public function insert(Client $client) : bool {

        try {
            $query = "INSERT INTO client (cpf, email, pass) VALUES (:cpf, :email, :pass)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":cpf", $client->getCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $client->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":pass", $client->getPass(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                $this->id = $this->conn->lastInsertId();
                $stmt->closeCursor();

                return true;
            }

            return false;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function update(Client $client) : bool {

        try {
            $query = "UPDATE client SET name = :name, surname = :surname, cpf = :cpf, email = :email, pass = :pass,
            ordenado = :ordenado, active = 1 WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $client->getId(), PDO::PARAM_INT);
            $stmt->bindValue(":name", $client->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":surname", $client->getSurname(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $client->getCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $client->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":pass", $client->getPass(), PDO::PARAM_STR);
            $stmt->bindValue(":ordenado", $client->getOrdenado(),PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $stmt->closeCursor();
                    
                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function updatePass(Client $client) : bool{
        $query = "UPDATE client SET pass = :pass WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id",$client->getId(),PDO::PARAM_INT);
        $stmt->bindValue(":pass",$client->getPass(),PDO::PARAM_STR);
        if ($stmt->execute()){
            return true;
        }
        return false;

    }


    public function delete(int $id) : bool {

        try {
            $query = "DELETE FROM client WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $stmt->closeCursor();
                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function getClient(int $id) : Client {
        $client = new Client();

        try {
            $query = "SELECT id, name, surname, cpf, email,ordenado, active FROM client WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $clientObj = new stdClass();
                $clientObj = $stmt->fetch(PDO::FETCH_OBJ);

                $client->setId(intval($clientObj->id));
                $client->setName($clientObj->name);
                $client->setSurname($clientObj->surname);
                $client->setCpf($clientObj->cpf);
                $client->setEmail($clientObj->email);
                $client->setActive(intval($clientObj->active));
                $client->setOrdenado(floatval($clientObj->ordenado));
                $stmt->closeCursor();

                return $client;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return $client;
    }

    public function isActived(int $id) : bool {
        $client = new Client();

        try {
            $query = "SELECT active FROM client WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $stmt->closeCursor();

                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function getIdToken(Client $client) {
      
        try{
            $query = "SELECT id,token FROM client WHERE cpf=:cpf AND name=:name AND email=:email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':cpf',$client->getCpf(),PDO::PARAM_STR);
            $stmt->bindValue(':name',$client->getName(),PDO::PARAM_STR);
            $stmt->bindValue(':email',$client->getEmail(),PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $id_token = $stmt->fetch(PDO::FETCH_ASSOC);
                 return $id_token;
            }
            return false;
        }catch(PDOException $e){
            die("Error: ".$e->getMessage);
        }
    }

}