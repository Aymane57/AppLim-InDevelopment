<?php

require_once 'dao/daoCompany.php';

class companyController {

    static function add() {
        for ($i = 0; $i < 100; $i++) {
            if (isset($_GET['validate']) && $_GET['validate'] === '1') {

                $company = new Company(array(
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
                $company->setKeyword(substr($keywords, 0, -1));


                while (true) {
                    $id = rand(100000, 999999);
                    if (DaoCompany::getById($id) == NULL) {
                        $company->setId('E' . $id);
                        break;
                    }
                }

                if ($company->getName() == NULL || $company->getCity() == NULL || $company->getZip() == NULL || $company->getCountry() == NULL) {
                    $message = "blank";
                    require_once 'view/company.php';
                } else {
                    DaoCompany::add($company);
                    header('Location: ?page=company/show&message=done&id=E' . $id);
                }
            } else {
                require_once 'view/company.php';
            }
        }
    }

    static function show() {
        if (isset($_GET['validate']) && $_GET['validate'] === '1' && isset($_POST['id'])) {

            $company = new Company(array(
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
            $company->setKeyword(substr($keywords, 0, -1));

            if ($company->getName() == NULL || $company->getCity() == NULL || $company->getZip() == NULL || $company->getCountry() == NULL) {
                $message = "blank";
                require_once 'view/company.php';
            } else {
                DaoCompany::update($company);
                header('Location: ?page=company/show&message=done&id=' . $company->getId());
            }
        } elseif (isset($_GET['id'])) {
            $company = DaoCompany::getById($_GET['id']);
            require_once 'view/company.php';
        }
    }

    static function all() {

        $begin = isset($_GET['p']) ? intval($_GET['p']) * 15 - 15 : 0;
        $term = isset($_GET['search']) ? $_GET['search'] : '';
        $totalPages = DaoCompany::count() % 15 == 0 ? intval(DaoCompany::count() / 15) : intval(DaoCompany::count() / 15) + 1;
        $companies = DaoCompany::getList($begin, $term, 'name', 'ASC');
        require_once 'view/liste_company.php';
    }

}

?>