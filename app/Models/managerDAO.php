<?php declare(strict_types=1);

namespace app\Models;

use app\Core\Connection;
use app\Models\Manager;
use app\Models\Address;
use app\Models\AddressDAO;
use \PDOException;
use \stdClass;
use \PDO;

class ManagerDAO {

    private ?PDO $conn;

    public function __construct() {
        $this->conn = Connection::connect();
    }

    public function insert(Manager $manager) : bool {

        try {
            $query = "INSERT INTO manager (name, surname, cpf, email, pass) VALUES (:name, :surname, :cpf, :email, :pass)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":name", $manager->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":surname", $manager->getSurname(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $manager->getCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $manager->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":pass", $manager->getPass(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                $this->id = $this->conn->lastInsertId();
                $stmt->closeCursor();

                $addressDAO = new addressDAO();
                $addressDAO->insert($manager->getAddress(), array("manager_id" => $this->id));

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
            $query = "UPDATE client SET name = :name, surname = :surname, cpf = :cpf, email = :email,
            ordenado = :ordenado, phone = :phone, active = 1 WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $client->getId(), PDO::PARAM_INT);
            $stmt->bindValue(":name", $client->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":surname", $client->getSurname(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $client->getCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $client->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":ordenado", $client->getOrdenado(),PDO::PARAM_STR);
            $stmt->bindValue(":phone", $client->getPhone(),PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $stmt->closeCursor();
                $addressDAO = new AddressDAO();

                if ($client->getAddress()->getClientId() !== 0):
                    $addressDAO->update($client->getAddress(), array("client_id" => $client->getId()));
                else:
                    $addressDAO->insert($client->getAddress(), array("client_id" => $client->getId()));
                endif;
                    
                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function updatePass(Manager $manager) : bool {
        $query = "UPDATE manager SET pass = :pass WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id",$manager->getId(),PDO::PARAM_INT);
        $stmt->bindValue(":pass",$manager->getPass(),PDO::PARAM_STR);

        if ($stmt->execute()) :
            return true;
        endif;

        return false;

    }

    public function delete(int $id) : bool {

        try {
            $query = "DELETE FROM manager WHERE id = :id";
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

    public function getManager(int $id) : Manager {
        $manager = new Manager();

        try {
            $query = "SELECT id, name, surname, cpf, phone, email FROM manager WHERE id = :id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $managerObj = new stdClass();
                $managerObj = $stmt->fetch(PDO::FETCH_OBJ);
                $stmt->closeCursor();

                $manager->setId(intval($managerObj->id));
                $manager->setName($managerObj->name ?? "");
                $manager->setSurname($managerObj->surname ?? "");
                $manager->setCpf($managerObj->cpf);
                $manager->setPhone($managerObj->phone ?? "");
                $manager->setEmail($managerObj->email ?? "");
                $manager->setAddress($this->getAddress(intval($managerObj->id)));

                return $manager;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return $manager;
    }

    public function getAllManagers() : Array {
        $manager = new Manager();
        $managerList = [];

        try {
            $query = "SELECT * FROM manager";

            $stmt = $this->conn->query($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $managerObj = new stdClass();
                $managerObjList = $stmt->fetchAll(PDO::FETCH_OBJ);
                $stmt->closeCursor();

                foreach ($managerObjList as $managerItem => $managerObj):

                    $manager->setId(intval($managerObj->id));
                    $manager->setName($managerObj->name ?? "");
                    $manager->setSurname($managerObj->surname ?? "");
                    $manager->setCpf($managerObj->cpf);
                    $manager->setPhone($managerObj->phone ?? "");
                    $manager->setEmail($managerObj->email ?? "");
                    $manager->setAddress($this->getAddress(intval($managerObj->id)));

                    $managerList[] = $managerObj;
                endforeach;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return $managerList;
    }

    public function getPassById($id){
        $query = "SELECT pass From manager WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function getAddress(int $id) : Address {
        $address = new Address();

        try {
            $query = "SELECT * FROM address WHERE manager_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $addressObj = new stdClass();
                $addressObj = $stmt->fetch(PDO::FETCH_OBJ);
                $stmt->closeCursor();

                $address->setId(intval($addressObj->id));
                $address->setClientId(intval($addressObj->manager_id));
                $address->setZipcode($addressObj->zipcode);
                $address->setStreet($addressObj->street);
                $address->setNumber($addressObj->number);
                $address->setOptional($addressObj->optional);
                $address->setDistrict($addressObj->district);
                $address->setCity($addressObj->city);
                $address->setState($addressObj->state);
            
                return $address;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return $address;
    }

}