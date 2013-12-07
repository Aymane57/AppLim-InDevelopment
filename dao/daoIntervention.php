<?php

class DaoIntervention {

    static function getList() {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * FROM intervention");
        $query->execute();
        $companies = NULL;
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {
            $companies[$key] = new Intervention($value);
        }
        $query->closeCursor();
        $db = NULL;
        return $companies;
    }

    static function getById($id) {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * "
                . "FROM intervention "
                . "WHERE id_intervention = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $db = NULL;
        $intervention = null;
        if ($data != NULL) {
            $intervention = new Intervention($data);
        }
        return $intervention;
    }

    static function add(Intervention $intervention) {
        $db = connect::getInstance();
        $query = $db->prepare("INSERT INTO intervention SET "
                . "id_intervention = :id, "
                . "section = :section, "
                . "id_app = :id_app, "
                . "date_beginning = :date_beg, "
                . "date_end = :date_end, "
                . "id_manager = :id_manager, "
                . "title = :title, "
                . "description = :description");

        $query->bindValue(':id', $intervention->getId_Intervention());
        $query->bindValue(':section', $intervention->getSection());
        $query->bindValue(':id_app', $intervention->getApp()->getId());
        $query->bindValue(':date_beg', $intervention->getDate_beginning());
        $query->bindValue(':date_end', $intervention->getDate_end());
        $query->bindValue(':id_manager', $intervention->getManager()->getId_manager());
        $query->bindValue(':title', $intervention->getTitle());
        $query->bindValue(':description', $intervention->getDescription());

        $query->execute();
        $query->closeCursor();
        $db = NULL;
    }

    static function update(Intervention $intervention) {
        $db = connect::getInstance();
        $query = $db->prepare("UPDATE intervention SET "
                . "section = :section, "
                . "id_app = :id_app,"
                . "date_beginning = :date_beg, "
                . "date_end = :date_end, "
                . "id_manager = :id_manager, "
                . "title = :title, "
                . "description = :description "
                . "WHERE id_intervention = :id");

        $query->bindValue(':id', $intervention->getId_Intervention());
        $query->bindValue(':section', $intervention->getSection());
        $query->bindValue(':id_app', $intervention->getApp()->getId());
        $query->bindValue(':date_beg', $intervention->getDate_beginning());
        $query->bindValue(':date_end', $intervention->getDate_end());
        $query->bindValue(':id_manager', $intervention->getManager()->getId_manager());
        $query->bindValue(':title', $intervention->getTitle());
        $query->bindValue(':description', $intervention->getDescription());

        $query->execute();
        $query->closeCursor();
        $db = NULL;
    }

}

?>