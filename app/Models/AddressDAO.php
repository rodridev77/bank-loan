<?php declare(strict_types=1);

namespace app\Models;

use app\Core\Connection;
use app\Models\Address;
use \PDOException;
use \stdClass;
use \PDO;

class AddressDAO {

    private ?PDO $address;

    public function __construct() {
        $this->conn = Connection::connect();
    }

    public function insert(Address $address, $fkey) : bool {
        $fkeyIndex = array_keys($fkey);
        $fkeyIndex = array_shift($fkeyIndex);
        $fkeyValue = array_values($fkey);
        $fkeyValue = array_shift($fkeyValue);

        try {
            $query = "INSERT address (zipcode, street, number, optional, district, city, state, $fkeyIndex) VALUES 
            (:zipcode, :street, :number, :optional, :district, :city, :state, :".$fkeyIndex.")";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":zipcode", $address->getZipcode(), PDO::PARAM_STR);
            $stmt->bindValue(":street", $address->getStreet(), PDO::PARAM_STR);
            $stmt->bindValue(":number", $address->getNumber(), PDO::PARAM_INT);
            $stmt->bindValue(":optional", $address->getOptional(), PDO::PARAM_STR);
            $stmt->bindValue(":district", $address->getDistrict(), PDO::PARAM_STR);
            $stmt->bindValue(":city", $address->getCity(), PDO::PARAM_STR);
            $stmt->bindValue(":state", $address->getState(), PDO::PARAM_STR);
            $stmt->bindValue(":$fkeyIndex", $fkeyValue, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $stmt->closeCursor();

                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function update(Address $address, $fkey) : bool {
        $fkeyIndex = array_keys($fkey);
        $fkeyIndex = array_shift($fkeyIndex);
        $fkeyValue = array_values($fkey);
        $fkeyValue = array_shift($fkeyValue);

        try {
            $query = "UPDATE address SET zipcode = :zipcode, street = :street, number = :number, 
            optional = :optional, district = :district, city = :city, state = :state WHERE $fkeyIndex = :".$fkeyIndex;

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":zipcode", $address->getZipcode(), PDO::PARAM_STR);
            $stmt->bindValue(":street", $address->getStreet(), PDO::PARAM_STR);
            $stmt->bindValue(":number", $address->getNumber(), PDO::PARAM_INT);
            $stmt->bindValue(":optional", $address->getOptional(), PDO::PARAM_STR);
            $stmt->bindValue(":district", $address->getDistrict(), PDO::PARAM_STR);
            $stmt->bindValue(":city", $address->getCity(), PDO::PARAM_STR);
            $stmt->bindValue(":state", $address->getState(), PDO::PARAM_STR);
            $stmt->bindValue(":$fkeyIndex", $fkeyValue, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $stmt->closeCursor();

                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
    }

    public function delete($fkey) : bool {
        $fkeyIndex = array_keys($fkey);
        $fkeyIndex = array_shift($fkeyIndex);
        $fkeyValue = array_values($fkey);
        $fkeyValue = array_shift($fkeyValue);

        try {
            $query = "DELETE FROM address WHERE $fkeyIndex = :".$fkeyIndex;
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":$fkeyIndex", $fkeyValue, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $stmt->closeCursor();
                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return false;
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

}