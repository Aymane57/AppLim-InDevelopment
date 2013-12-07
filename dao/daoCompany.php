<?php

class DaoCompany {

    static function getList($debut, $term, $tri, $method) {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * FROM company WHERE ("
                . "name = :term OR "
                . "id = :term OR "
                . "acronym = :term OR "
                . "city = :term OR "
                . "zip = :term OR "
                . "country = :term OR "
                . "registred_office = :term OR "
                . "city_ro = :term OR "
                . "zip_ro = :term OR "
                . "country_ro = :term) "
                . "ORDER BY " . $tri . " " . $method . " "
                . "LIMIT :debut , 15");
        $query->bindValue(':debut', $debut, PDO::PARAM_INT);
        $query->bindValue(':term', $term);

        $query->execute();
        $companies = NULL;
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $key => $value) {
            $companies[$key] = new Company($value);
        }
        $query->closeCursor();
        $db = NULL;
        return $companies;
    }

    static function getById($id) {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT * "
                . "FROM company "
                . "WHERE id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $db = NULL;
        $company = null;
        if ($data != NULL) {
            $company = new Company($data);
        }
        return $company;
    }

    static function add(Company $company) {
        $db = connect::getInstance();
        $query = $db->prepare("INSERT INTO company SET " . $company->toString());
        $query->execute();
        $query->closeCursor();
        $db = NULL;
    }

    static function update(Company $company) {
        $db = connect::getInstance();
        $query = $db->prepare("UPDATE company SET " . $company->toString() . " WHERE id = :id");
        $query->bindValue(':id', $company->getId());

        $query->execute();
        $query->closeCursor();
        $db = NULL;
    }

    static function count() {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT COUNT(id) as count FROM company");

        $query->execute();

        $data = $query->fetch();
        $query->closeCursor();
        $db = NULL;
        return $data['count'];
    }

}

?>