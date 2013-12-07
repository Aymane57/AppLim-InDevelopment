<?php
require_once 'dao/daoCompany.php';
require_once 'dao/daoAssociate.php';

class associateController {

    static function add() {

        if (isset($_GET['validate']) && $_GET['validate'] === '1') {

            $associate = new Associate(array(
                'name' => trim($_POST['coName']),
                'acronym' => trim($_POST['coAcronym']),
                'address' => trim($_POST['coAddress']),
                'city' => trim($_POST['coCity']),
                'zip' => trim($_POST['coCp']),
                'country' => trim($_POST['coCountry']),
                'phone' => trim($_POST['coPhone']),
                'fax' => trim($_POST['coFax']),
                'mail' => trim($_POST['coMail']),
                'registred_office' => trim($_POST['roName']),
                'adress_ro' => trim($_POST['roAddress']),
                'city_ro' => trim($_POST['roCity']),
                'zip_ro' => trim($_POST['roCp']),
                'country_ro' => trim($_POST['roCountry']),
                'phone_ro' => trim($_POST['roPhone']),
                'fax_ro' => trim($_POST['roFax']),
                'mail_ro' => trim($_POST['roMail']),
                'type' => trim($_POST['coType']),
                'num_siret' => trim($_POST['coSiret'])
            ));

            $keywords = "";
            for ($i = 1; $i <= 10; $i++) {
                if (isset($_POST['kw' . $i]) && trim($_POST['kw' . $i]) != NULL) {
                    $keywords .= trim($_POST['kw' . $i]) . ",";
                }
            }
            $associate->setKeyword(substr($keywords, 0, -1));


            while (true) {
                $id = rand(100000, 999999);
                if (DaoAssociate::getById($id) == NULL) {
                    $associate->setId('E' . $id);
                    break;
                }
            }

            if ($associate->getName() == NULL || $associate->getCity() == NULL || $associate->getZip() == NULL || $associate->getCountry() == NULL) {
                $message = "blank";
                require_once 'view/associate.php';
            } else {
                DaoAssociate::add($associate);
                header('Location: ?page=associate/show&message=done&id=E' . $id);
            }
        } else {
            require_once 'view/associate.php';
        }
    }

    static function show() {
        if (isset($_GET['validate']) && $_GET['validate'] === '1' && isset($_POST['id'])) {

            $associate = new Associate(array(
                'id' => $_POST['id'],
                'name' => trim($_POST['coName']),
                'acronym' => trim($_POST['coAcronym']),
                'address' => trim($_POST['coAddress']),
                'city' => trim($_POST['coCity']),
                'zip' => trim($_POST['coCp']),
                'country' => trim($_POST['coCountry']),
                'phone' => trim($_POST['coPhone']),
                'fax' => trim($_POST['coFax']),
                'mail' => trim($_POST['coMail']),
                'registred_office' => trim($_POST['roName']),
                'adress_ro' => trim($_POST['roAddress']),
                'city_ro' => trim($_POST['roCity']),
                'zip_ro' => trim($_POST['roCp']),
                'country_ro' => trim($_POST['roCountry']),
                'phone_ro' => trim($_POST['roPhone']),
                'fax_ro' => trim($_POST['roFax']),
                'mail_ro' => trim($_POST['roMail']),
                'type' => trim($_POST['coType']),
                'num_siret' => trim($_POST['coSiret'])
            ));

            $keywords = "";
            for ($i = 1; $i <= 10; $i++) {
                if (isset($_POST['kw' . $i]) && trim($_POST['kw' . $i]) != NULL) {
                    $keywords .= trim($_POST['kw' . $i]) . ",";
                }
            }
            $associate->setKeyword(substr($keywords, 0, -1));

            if ($associate->getName() == NULL || $associate->getCity() == NULL || $associate->getZip() == NULL || $associate->getCountry() == NULL) {
                $message = "blank";
                require_once 'view/associate.php';
            } else {
                DaoAssociate::update($associate);
                header('Location: ?page=associate/show&message=done&id=' . $associate->getId());
            }
        } elseif (isset($_GET['id'])) {
            $associate = DaoAssociate::getById($_GET['id']);
            require_once 'view/associate.php';
        }
    }

}
?>