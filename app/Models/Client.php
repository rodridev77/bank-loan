<?php

namespace app\Models;

use app\Models\Address;

class Client {
    private int $id;
    private string $name;
    private string $surname;
    private string $cpf;
    private string $phone;
    private string $email;
    private string $pass;
    private float $ordenado;
    private int $active;
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

    public function setSurname(string $surname) : void {
        $this->surname = ucwords(trim($surname));
    }

    public function getSurname() : string {
        return $this->surname ?? "";
    }

    public function setCpf(string $cpf) : void {
        $this->cpf = trim($cpf);
    }

    public function getCpf() : string {
        return $this->cpf;
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

    public function setPass(string $pass) : void {
        $this->pass = preg_match('/^[a-f0-9]{32}$/', $pass) ? $pass : md5(trim($pass));
    }

    public function getPass() : string {
        return $this->pass;
    }

    public function setOrdenado(float $ordenado) : void {
        $this->ordenado = trim($ordenado);
    }

    public function getOrdenado() : float {
        return $this->ordenado ?? 0;
    }

    public function setActive(int $active) : void {
        $this->active = trim($active);
    }

    public function getActive() : int {
        return $this->active;
    }

    public function setAddress(Address $address) : void {
        $this->address = $address;
    }

    public function getAddress() : Address {
        return $this->address ?? new Address;
    }
}