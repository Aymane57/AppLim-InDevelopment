<?php

class Intervention {

    private $id_Intervention;
    private $section;
    private $app;
    private $date_beginning;
    private $date_end;
    private $manager;
    private $title;
    private $description;
  

    function __construct(array $data) {
        $this->manager = new Manager($data);
        $this->app = new Company($data);
        if (substr($this->app->getId(), 0, 1) == 'P') {
            $this->app = new People($data);
        }
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId_Intervention() {
        return $this->id_Intervention;
    }

    public function getSection() {
        return $this->section;
    }

    public function getApp() {
        return $this->app;
    }

    public function getDate_beginning() {
        return $this->date_beginning;
    }

    public function getDate_end() {
        return $this->date_end;
    }

    public function getManager() {
        return $this->manager;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId_Intervention($id) {
        $this->id_Intervention = $id;
    }

    public function setSection($section) {
        $this->section = $section;
    }

    public function setApp($app) {
        $this->app = $app;
    }

    public function setDate_beginning($date_beginning) {
        $this->date_beginning = $date_beginning;
    }

    public function setDate_end($date_end) {
        $this->date_end = $date_end;
    }

    public function setManager($manager) {
        $this->manager = $manager;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

}
