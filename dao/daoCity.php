<?php

class daoCity {

    static function getAll($part, $country) {
        $db = connect::getInstance();
        $query = $db->prepare("SELECT city, zip "
                . "FROM company "
                . "WHERE (city LIKE '" . $part . "%' "
                . "OR zip LIKE '" . $part . "%') "
                . "AND country = '" . $country . "' "
                . "UNION "
                . "SELECT city_ro AS city, zip_ro AS zip "
                . "FROM company "
                . "WHERE (city LIKE '" . $part . "%' "
                . "OR zip LIKE '" . $part . "%') "
                . "AND country_ro = '" . $country . "' "
                . "UNION "
                . "SELECT city, zip "
                . "FROM people "
                . "WHERE (city LIKE '" . $part . "%' "
                . "OR zip LIKE '" . $part . "%') "
                . "AND country = '" . $country . "'");

        $query->execute();
        $cities = $query->fetchAll();
        $query->closeCursor();
        $db = NULL;
        return $cities;
    }

}
