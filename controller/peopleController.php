<?php

require_once 'dao/daoPeople.php';

class peopleController {

    static function add() {

        if (isset($_GET['validate']) && $_GET['validate'] === '1') {


            $parts = explode('/', trim($_POST['coBorn']));
            $date = '';
            if (sizeOf($parts) > 1) {
                $date = trim($parts[2] . '-' . $parts[1] . '-' . $parts[0]);
            }

            $people = new People(array(
                'name' => trim($_POST['coName']),
                'firstname' => trim($_POST['coFirstname']),
                'address' => trim($_POST['coAddress']),
                'sexe' => isset($_POST['coCivilite']) ? trim($_POST['coCivilite']) : 0,
                'city' => trim($_POST['coCity']),
                'zip' => trim($_POST['coCp']),
                'country' => trim($_POST['coCountry']),
                'phone' => trim($_POST['coPhone']),
                'email' => trim($_POST['coMail']),
                'date_born' => trim($_POST['coBorn']),
                'nationality' => trim($_POST['coNationality'])
            ));


            $keywords = "";
            for ($i = 1; $i <= 10; $i++) {
                if (isset($_POST['kw' . $i]) && trim($_POST['kw' . $i]) != NULL) {
                    $keywords .= trim($_POST['kw' . $i]) . ",";
                }
            }
            $people->setKeyword(substr($keywords, 0, -1));


            while (true) {
                $id = rand(100000, 999999);
                if (DaoPeople::getById($id) == NULL) {
                    $people->setId('P' . $id);
                    break;
                }
            }

            if ($people->getName() == NULL || $people->getFirstname() == NULL || $people->getCity() == NULL || $people->getZip() == NULL || $people->getCountry() == NULL) {
                $message = "blank";
                require_once 'view/people.php';
            } else {
                DaoPeople::add($people);
                header('Location: ?page=people/show&message=done&id=P' . $id);
            }
        } else {
            require_once 'view/people.php';
        }
    }

    static function show() {
        if (isset($_GET['validate']) && $_GET['validate'] === '1' && isset($_POST['id'])) {


            $parts = explode('/', trim($_POST['coBorn']));
            $date = '';
            if (sizeOf($parts) > 1) {
                $date = trim($parts[2] . '-' . $parts[1] . '-' . $parts[0]);
            }

            $people = new People(array(
                'id' => $_POST['id'],
                'name' => trim($_POST['coName']),
                'firstname' => trim($_POST['coFirstname']),
                'address' => trim($_POST['coAddress']),
                'sexe' => isset($_POST['coCivilite']) ? trim($_POST['coCivilite']) : 0,
                'city' => trim($_POST['coCity']),
                'zip' => trim($_POST['coCp']),
                'country' => trim($_POST['coCountry']),
                'phone' => trim($_POST['coPhone']),
                'email' => trim($_POST['coMail']),
                'date_born' => $date,
                'nationality' => trim($_POST['coNationality']),
            ));



            $keywords = "";
            for ($i = 1; $i <= 10; $i++) {
                if (isset($_POST['kw' . $i]) && trim($_POST['kw' . $i]) != NULL) {
                    $keywords .= trim($_POST['kw' . $i]) . ",";
                }
            }
            $people->setKeyword(substr($keywords, 0, -1));
            if ($people->getName() == NULL || $people->getCity() == NULL || $people->getFirstname() == NULL || $people->getZip() == NULL || $people->getCountry() == NULL) {
                $message = "blank";
                require_once 'view/people.php';
            } else {
                DaoPeople::update($people);
                header('Location: ?page=people/show&message=done&id=' . $people->getId());
            }
        } elseif (isset($_GET['id'])) {
            $people = DaoPeople::getById($_GET['id']);
            require_once 'view/people.php';
        }
    }

}

?>
