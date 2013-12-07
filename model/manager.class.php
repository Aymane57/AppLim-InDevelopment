<?php

class Manager {

    private $id_manager;
    private $name;
    private $firstname;
    private $rights;
    private $login;
    private $pwd;

    function __construct(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId_manager() {
        return $this->id_manager;
    }

    public function getName() {
        return $this->name;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getRights() {
        return $this->rights;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPwd() {
        return $this->pwd;
    }

    public function setId_manager($id_manager) {
        $this->id_manager = $id_manager;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setRights($rights) {
        $this->rights = $rights;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
    }

}
