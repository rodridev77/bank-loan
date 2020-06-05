<?php declare(strict_types=1);

namespace app\Models;

use app\Core\Connection;
use app\Models\Bank;
use app\Models\Address;
use \PDOException;
use \stdClass;
use \PDO;

class BankDAO {

    private ?PDO $conn;
    private int $id;

    public function __construct() {
        $this->conn = Connection::connect();
    }

    public function insert(Bank $bank) : bool {

        try {
            $query = "INSERT INTO bank (name, cnpj, phone, email) VALUES (:name, :cnpj, :phone, :email)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":name", $bank->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":cnpj", $bank->getCnpj(), PDO::PARAM_STR);
            $stmt->bindValue(":phone", $bank->getPhone(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $bank->getEmail(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                $this->id = intval($this->conn->lastInsertId());
                $stmt->closeCursor();

                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function update(Bank $bank) : bool {

        try {
            $query = "UPDATE bank SET name = :name, cnpj = :cnpj, phone = :phone, email = :email WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $bank->getId(), PDO::PARAM_INT);
            $stmt->bindValue(":name", $bank->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":cnpj", $bank->getCnpj(), PDO::PARAM_STR);
            $stmt->bindValue(":phone", $bank->getPhone(),PDO::PARAM_STR);
            $stmt->bindValue(":email", $bank->getEmail(), PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $stmt->closeCursor();
                $addressDAO = new AddressDAO();

                if ($bank->getAddress()->getClientId() !== 0):
                    $addressDAO->update($bank->getAddress(), $bank->getId());
                else:
                    $addressDAO->insert($bank->getAddress(), $bank->getId());
                endif;
                    
                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function delete(int $id) : bool {

        try {
            $query = "DELETE FROM bank WHERE id = :id";
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

    public function getAddress(int $id) : Address {
        $address = new Address();

        try {
            $query = "SELECT * FROM address WHERE bank_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $addressObj = new stdClass();
                $addressObj = $stmt->fetch(PDO::FETCH_OBJ);
                $stmt->closeCursor();

                $address->setId(intval($addressObj->id));
                $address->setClientId(intval($addressObj->client_id));
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

    public function getBank(int $bankId) : Bank {
        $bank = new Bank();

        try {
            $query = "SELECT id, name, cnpj, phone, email FROM bank WHERE id = :bank_id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":bank_id", $bankId, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $bankObj = new stdClass();
                $bankObj = $stmt->fetch(PDO::FETCH_OBJ);
                $stmt->closeCursor();

                $bank->setId(intval($bankObj->id));
                $bank->setName($bankObj->name ?? "");
                $bank->setCnpj($bankObj->cnpj);
                $bank->setPhone($bankObj->phone ?? "");
                $bank->setEmail($bankObj->email ?? "");
                $bank->setAddress($this->getAddress(intval($bankObj->id)));

                return $bank;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return $bank;
    }

    public function getAllBanks() : Array {
        $bank = new Bank();
        $bankList = [];

        try {
            $query = "SELECT id, name, cnpj, phone, email FROM bank";

            $stmt = $this->conn->query($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $bankObj = new stdClass();
                $bankObjList = $stmt->fetchAll(PDO::FETCH_OBJ);
                $stmt->closeCursor();

                foreach ($bankObjList as $bankItem => $bankObj):

                    $bank->setId(intval($bankObj->id));
                    $bank->setName($bankObj->name ?? "");
                    $bank->setCnpj($bankObj->cnpj);
                    $bank->setPhone($bankObj->phone ?? "");
                    $bank->setEmail($bankObj->email ?? "");
                    $bank->setAddress($this->getAddress(intval($bankObj->id)));

                    $bankList[] = $bankObj;
                endforeach;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return $bankList;
    }

    public function getId() : int {
        return $this->id;
    }
}