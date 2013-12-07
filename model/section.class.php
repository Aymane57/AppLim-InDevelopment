<?php

class Section {

    private $id_section;
    private $name;


    function __construct(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    
    public function getId_section() {
        return $this->id_section;
    }

    public function getName() {
        return $this->name;
    }

    public function setId_section($id_section) {
        $this->id_section = $id_section;
    }

    public function setName($name) {
        $this->name = $name;
    }



}
