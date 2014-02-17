<?php

class DaoPeople {

    static function getList() {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * FROM people");
        $query->execute();
        $peopleList = NULL;
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {
            $peopleList[$key] = new People($value);
        }
        $query->closeCursor();
        $db = NULL;
        return $peopleList;
    }

    static function getListCompany($id_company, $id_people) {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * FROM associate, company, people WHERE id_company = id_people");
        $query->bindValue(':id_company', $id_company);
        $query->bindValue(':id_people', $id_people);

        $query->execute();
        $peopleList = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $db = NULL;
        return $peopleList;
    }

    static function getById($id) {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * "
                . "FROM people "
                . "WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $db = NULL;
        $people = null;
        if ($data != NULL) {
            $people = new People($data);
        }
        return $people;
    }

    static function add(People $people) {
        $db = connect::getInstance();
        $query = $db->prepare("INSERT INTO people SET " . $people->toString());
        $query->execute();
        $query->closeCursor();
        $db = NULL;
    }

    static function update(People $people) {
        $db = connect::getInstance();
        $query = $db->prepare("UPDATE people SET " . $people->toString() . " WHERE id = :id");
        $query->bindValue(':id', $people->getId());

        $query->execute();
        $query->closeCursor();
        $db = NULL;
    }

    static function getLast() {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT MAX(id) as id FROM people");

        $query->execute();

        $data = $query->fetch();
        $query->closeCursor();
        $db = NULL;
        return $data['id'];
    }

}

?>