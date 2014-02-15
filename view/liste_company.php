<?php
if (!isset($companies)) {
    $companies = NULL;
}
$current = isset($_GET['p']) ? $_GET['p'] : 1;
$begin = $current - 2 <= 2 ? 2 : $current - 2;
$end = $current + 2 >= $totalPages ? $totalPages - 1 : $current + 2;
?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="docs-assets/ico/favicon.png">

        <title>Lorraine Internationale Mobilité</title>

        <!-- Bootstrap core CSS -->
        <link href="view/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

        <!-- Custom styles for this template -->
        <link href="view/dist/css/offcanvas.css" rel="stylesheet">
        <link href="view/includes/style.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->


    </head>
    <body>

        <?php include_once 'view/includes/header.php'; ?>

        <div class="container">
            <a href="?page=company/add">
                <button type="button" class="btn btn-primary btn-lg pull-left">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Nouvelle
                </button>
            </a>
            <?php if (empty($companies)) : ?>
                <?php echo 'Vide'; ?>
            <?php else : ?>
                <ul class="pagination pull-right">
                    <li<?php if ($current == 1) : ?> class="active"<?php endif; ?>><a href="?page=company/all&p=1">1</a></li>
                    <?php if ($current > 4) : ?>
                        <li><a>...</a></li>
                    <?php endif; ?>
                    <?php for ($i = $begin; $i <= $end; $i++) : ?>
                        <li<?php if ($i == $current) : ?> class="active"<?php endif; ?>><a href="?page=company/all&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                    <?php if ($current < $totalPages - 3) : ?>
                        <li><a>...</a></li>
                    <?php endif; ?>
                    <li<?php if ($totalPages == $current) : ?> class="active"<?php endif; ?>><a href="?page=company/all&p=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a></li>
                </ul>
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <tr class="success">
                            <th>#</th>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>CP - Ville</th>
                            <th>Pays</th>
                            <th>Date d'ajout</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($companies as $key => $company) : ?>

                            <?php setlocale(LC_ALL, 'french', 'fr_FR', 'fr_FR.UTF-8'); ?>
                            <?php $date_add = utf8_encode(strftime("%d %b %Y", strtotime($company->getAdd_date()))); ?>
                            <?php if ($key % 2 == 0) : ?>
                                <tr>
                                <?php else : ?>
                                <tr class="active">
                                <?php endif; ?>
                                <td><?php echo $company->getId(); ?></td>
                                <td><?php echo $company->getName(); ?></td>
                                <td><?php echo $company->getAddress(); ?></td>
                                <td><?php echo $company->getZip(); ?> - <?php echo $company->getCity(); ?></td>
                                <td><?php echo $company->getCountry(); ?></td>
                                <td><?php echo $date_add ?></td>
                                <td><a href="?page=company/show&id=<?php echo $company->getId(); ?>"><span class="glyphicon glyphicon-edit"></span></a> <span class="glyphicon glyphicon-trash"></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

            <?php endif; ?>
            <footer>
                <hr>
                <div class="text-info text-right"> Application Lorraine Internationale Mobilité - (c) World Trade Center Metz-Saarbrücken</div>
            </footer>
        </div><!--/.container-->



        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="view/dist/js/bootstrap.min.js"></script>
        <script src="view/dist/js/offcanvas.js"></script>
        <script src="view/includes/js/autocomplete.js"></script>
    </body>
</html>

