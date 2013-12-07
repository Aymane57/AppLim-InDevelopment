<?php

class associate {

    private $id_company;
    private $id_people;
    private $beginning;
    private $end;
    private $fonction;
    private $tel;
    private $e_mail;
    private $leader;

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

    public function getId_company() {
        return $this->id_company;
    }

    public function getId_people() {
        return $this->id_people;
    }

    public function getBeginning() {
        return $this->beginning;
    }

    public function getEnd() {
        return $this->end;
    }

    public function getFonction() {
        return $this->fonction;
    }

    public function getTel() {
        return $this->tel;
    }

    public function getE_mail() {
        return $this->e_mail;
    }

    public function getLeader() {
        return $this->leader;
    }

    public function setId_company($id_company) {
        $this->id_company = $id_company;
    }

    public function setId_people($id_people) {
        $this->id_people = $id_people;
    }

    public function setBeginning($beginning) {
        $this->beginning = $beginning;
    }

    public function setEnd($end) {
        $this->end = $end;
    }

    public function setFonction($fonction) {
        $this->fonction = $fonction;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function setE_mail($e_mail) {
        $this->e_mail = $e_mail;
    }

    public function setLeader($leader) {
        $this->leader = $leader;
    }

}
