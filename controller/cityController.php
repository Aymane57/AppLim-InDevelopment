<?php

require_once 'dao/daoCity.php';

class cityController {

    static function getCities() {

        if (isset($_GET['country']) && isset($_GET['part'])) {
            echo json_encode(daoCity::getAll($_GET['part'], $_GET['country']));
        }
    }

}
