<?php

namespace app\Models;

use app\Models\Address;

class Bank {
    private int $id;
    private string $name;
    private string $cnpj;
    private string $phone;
    private string $email;
    private ?Address $address;

    public function setId(int $id) : void {
        $this->id = trim($id);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setName(string $name) : void {
        $this->name = ucwords(trim($name));
    }

    public function getName() : string {
        return $this->name ?? "";
    }

    public function setCnpj(string $cnpj) : void {
        $this->cnpj = trim($cnpj);
    }

    public function getCnpj() : string {
        return $this->cnpj ?? "";
    }

    public function setPhone(string $phone) : void {
        $this->phone = trim($phone);
    }

    public function getPhone() : string {
        return $this->phone ?? "";
    }

    public function setEmail(string $email) : void {
        $this->email = strtolower(trim($email));
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function setAddress(Address $address) : void {
        $this->address = $address;
    }

    public function getAddress() : Address {
        return $this->address ?? new Address;
    }
}