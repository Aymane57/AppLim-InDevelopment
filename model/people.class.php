<?php

class People {

    private $id;
    private $name;
    private $firstname;
    private $sexe;
    private $address;
    private $city;
    private $zip;
    private $country;
    private $phone;
    private $email;
    private $date_born;
    private $nationality;
    private $keyword;
    private $add_date;

    function __construct(array $data) {

        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    function toString() {
        $string = '';
        foreach (get_object_vars($this) as $key => $value) {
            if (isset($value)) {
                $string .= $key . '="' . $value . '", ';
            }
        }
        return substr($string, 0, -2);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
    }
    public function getAdd_date() {
        return $this->add_date;
    }

    public function setAdd_date($add_date) {
        $this->add_date = $add_date;
    }

        public function getZip() {
        return $this->zip;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDate_born() {
        return $this->date_born;
    }

    public function getNationality() {
        return $this->nationality;
    }

    public function getKeyword() {
        return $this->keyword;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setZip($zip) {
        $this->zip = $zip;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDate_born($date_born) {
        $this->date_born = $date_born;
    }

    public function setNationality($nationality) {
        $this->nationality = $nationality;
    }

    public function setKeyword($keyword) {
        $this->keyword = $keyword;
    }

}
