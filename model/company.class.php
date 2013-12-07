<?php

class Company {

    private $id;
    private $name;
    private $acronym;
    private $address;
    private $city;
    private $zip;
    private $country;
    private $phone;
    private $fax;
    private $mail;
    private $registred_office;
    private $address_ro;
    private $city_ro;
    private $zip_ro;
    private $country_ro;
    private $phone_ro;
    private $fax_ro;
    private $mail_ro;
    private $type;
    private $keyword;
    private $num_siret;
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

    public function getAcronym() {
        return $this->acronym;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
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

    public function getFax() {
        return $this->fax;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getRegistred_office() {
        return $this->registred_office;
    }

    public function getAddress_ro() {
        return $this->address_ro;
    }

    public function getCity_ro() {
        return $this->city_ro;
    }

    public function getZip_ro() {
        return $this->zip_ro;
    }

    public function getCountry_ro() {
        return $this->country_ro;
    }

    public function getPhone_ro() {
        return $this->phone_ro;
    }

    public function getFax_ro() {
        return $this->fax_ro;
    }

    public function getMail_ro() {
        return $this->mail_ro;
    }

    public function getType() {
        return $this->type;
    }

    public function getKeyword() {
        return $this->keyword;
    }

    public function getNum_siret() {
        return $this->num_siret;
    }

    public function getAdd_date() {
        return $this->add_date;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAcronym($acronym) {
        $this->acronym = $acronym;
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

    public function setFax($fax) {
        $this->fax = $fax;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setRegistred_office($registred_office) {
        $this->registred_office = $registred_office;
    }

    public function setAddress_ro($address_ro) {
        $this->address_ro = $address_ro;
    }

    public function setCity_ro($city_ro) {
        $this->city_ro = $city_ro;
    }

    public function setZip_ro($zip_ro) {
        $this->zip_ro = $zip_ro;
    }

    public function setCountry_ro($country_ro) {
        $this->country_ro = $country_ro;
    }

    public function setPhone_ro($phone_ro) {
        $this->phone_ro = $phone_ro;
    }

    public function setFax_ro($fax_ro) {
        $this->fax_ro = $fax_ro;
    }

    public function setMail_ro($mail_ro) {
        $this->mail_ro = $mail_ro;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setKeyword($keyword) {
        $this->keyword = $keyword;
    }

    public function setNum_siret($num_siret) {
        $this->num_siret = $num_siret;
    }

    public function setAdd_date($add_date) {
        $this->add_date = $add_date;
    }

}
