<?php

class DaoAssociate {

    static function getList() {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * FROM associate");
        $query->execute();
        $companies = NULL;
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {
            $companies[$key] = new Associate($value);
        }
        $query->closeCursor();
        $db = NULL;
        return $companies;
    }

    static function getById($id) {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * "
                . "FROM associate "
                . "WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $db = NULL;
        $associate = null;
        if($data != NULL) {
            $associate = new Associate($data);
        }
        return $associate;
    }

    static function add(Associate $associate) {
        $db = connect::getInstance();
        $query = $db->prepare("INSERT INTO associate SET " . $associate->toString());
        $query->execute();
        $query->closeCursor();
        $db = NULL;
    }

    static function update(Associate $associate) {
        $db = connect::getInstance();
        $query = $db->prepare("UPDATE associate SET " . $associate->toString() . " WHERE id = :id");
        $query->bindValue(':id', $associate->getId());

        $query->execute();
        $query->closeCursor();
        $db = NULL;
    }

    static function getLast() {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT MAX(id) as id FROM associate");

        $query->execute();

        $data = $query->fetch();
        $query->closeCursor();
        $db = NULL;
        return $data['id'];
    }

}

?>