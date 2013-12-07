<?php

require_once 'dao/daoIntervention.php';
require_once 'dao/daoCompany.php';
require_once 'dao/daoPeople.php';

class interventionController {

    static function add() {

        if (isset($_GET['validate']) && $_GET['validate'] === '1') {


            $parts = explode('/', trim($_POST['date_beg']));
            $date_beg = '';
            if (sizeOf($parts) > 1) {
                $date_beg = trim($parts[2] . '-' . $parts[1] . '-' . $parts[0]);
            }


            $parts = explode('/', trim($_POST['date_end']));
            $date_end = '';
            if (sizeOf($parts) > 1) {
                $date_end = trim($parts[2] . '-' . $parts[1] . '-' . $parts[0]);
            }


            $app = NULL;
            if (substr($_POST['id_app'], 0, 1) == 'E') {
                $app = DaoCompany::getById($_POST['id_app']);
            } elseif (substr($_POST['id_app'], 0, 1) == 'P') {
                $app = DaoPeople::getById($_POST['id_app']);
            }


            $intervention = new Intervention(array(
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'section' => trim($_POST['section']),
                'app' => $app,
                'date_beginning' => $date_beg,
                'date_end' => $date_end,
            ));
            if ($app != NULL) {
                while (true) {
                    $id = rand(100000, 999999);
                    if (DaoIntervention::getById($id) == NULL) {
                        $intervention->setId_Intervention('I' . $id);
                        break;
                    }
                }

                if ($intervention->getTitle() == NULL) {
                    $message = "blank";
                    require_once 'view/intervention.php';
                } else {
                    DaoIntervention::add($intervention);
                    var_dump($intervention);
                    header('Location: ?page=intervention/show&message=done&id=I' . $id);
                }
            }
        } else {
            require_once 'view/intervention.php';
        }
    }

    static function show() {
        if (isset($_GET['validate']) && $_GET['validate'] === '1' && isset($_POST['id'])) {

            $parts = explode('/', trim($_POST['date_beg']));
            $date_beg = '';
            if (sizeOf($parts) > 1) {
                $date_beg = trim($parts[2] . '-' . $parts[1] . '-' . $parts[0]);
            }


            $parts = explode('/', trim($_POST['date_end']));
            $date_end = '';
            if (sizeOf($parts) > 1) {
                $date_end = trim($parts[2] . '-' . $parts[1] . '-' . $parts[0]);
            }

            $intervention = new Intervention(array(
                'id_intervention' => $_POST['id'],
                'title' => trim($_POST['title']),
                'section' => trim($_POST['section']),
                'description' => trim($_POST['description']),
                'date_beginning' => $date_beg,
                'date_end' => $date_end,
            ));


            if ($intervention->getTitle() == NULL) {
                $message = "blank";
                require_once 'view/intervention.php';
            } else {
                DaoIntervention::update($intervention);
                header('Location: ?page=intervention/show&message=done&id=' . $intervention->getId_Intervention());
            }
        } elseif (isset($_GET['id'])) {
            $intervention = DaoIntervention::getById($_GET['id']);
            require_once 'view/intervention.php';
        }
    }

}

?>