<?php

namespace app\Models;

class Address {
    private int $id;
    private string $zipcode;
    private string $street;
    private int $number;
    private string $optional;
    private string $district;
    private string $city;
    private string $state;

    public function setId(int $id) : void {
        $this->id = intval(trim($id));
    }
    
    public function getId() : int {
        return $this->id;
    }
    
    public function setZipcode(string $zipcode) : void {
        $this->zipcode = trim($zipcode);
    }

    public function getZipcode() : string {
        return $this->zipcode;
    }

    public function setStreet(string $street) : void {
        $this->street = ucwords(trim($street));
    }

    public function getStreet() : string {
        return $this->street;
    }

    public function setNumber(string $number) : void {
        $this->number = intval(trim($number));
    }

    public function getNumber() : int {
        return $this->number;
    }

    public function setOptional(string $optional) : void {
        $this->optional = trim($optional);
    }

    public function getOptional() : string {
        return $this->optional;
    }

    public function setDistrict(string $district) : void {
        $this->district = ucwords(trim($district));
    }

    public function getDistrict() : string {
        return $this->district;
    }

    public function setCity(string $city) : void {
        $this->city = ucwords(trim($city));
    }

    public function getCity() : string {
        return $this->city;
    }

    public function setState(string $state) : void {
        $this->state = ucwords(trim($state));
    }

    public function getState() : string {
        return $this->state;
    }
}