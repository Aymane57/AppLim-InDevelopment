<?php
if (!isset($intervention)) {
    $intervention = new Intervention(array('date_beginning' => date('Y-m-d'),
        'date_end' => "0000-00-00"));
}
?>

<html lang="en">
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
        <link href="view/includes/datepicker.css" rel="stylesheet">
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

            <?php
            if (isset($_GET['validate']) && $message == 'blank') :
                ?>

                <div class="alert alert-danger">
                    <div class="text-center"><strong>Erreur : Merci de renseigner les champs obligatoires</strong></div>
                </div>

                <?php
            endif;

            if ((isset($_GET['message']) && $_GET['message'] == "done")) :
                ?>

                <div class="alert alert-success">
                    <div class="text-center"><strong>Action effectuée avec succès</strong></div>
                </div>

            <?php endif; ?>

            <?php if ($_GET['page'] == "intervention/show" && isset($_GET['id'])) : ?>
                <div class="pull-left"><h6>ID : <strong><?php echo $_GET['id']; ?></strong></h6></div>
                <div class="btn-group-lg visible-xs pull-right">
                    <button type="button" class="btn btn-primary btn-md">
                        <span class="glyphicon glyphicon-paperclip"></span>
                    </button>
                    <button type="button" class="btn btn-primary btn-md">
                        <span class="glyphicon glyphicon-briefcase"></span>
                    </button>
                    <button type="button" class="btn btn-primary btn-md">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </button>

                    <button type="button" class="btn btn-danger btn-md">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </div>



                <div class="row">
                    <div class="visible-sm visible-md visible-lg pull-right">
                        <button type="button" class="btn btn-primary btn-md">
                            <span class="glyphicon glyphicon-paperclip"></span> Nouveau dossier
                        </button>
                        <button type="button" class="btn btn-primary btn-md">
                            <span class="glyphicon glyphicon-briefcase"></span> Lier une personne
                        </button>

                        <button type="button" class="btn btn-danger btn-md">
                            <span class="glyphicon glyphicon-trash"></span> Supprimer
                        </button>
                    </div>
                </div>


            <?php else : ?>
                <h2>Nouvelle intervention</h2>
            <?php endif; ?>
            <br /><br />

            <form class="form-horizontal" action=<?php echo "index.php?page=" . $_GET['page'] . "&validate=1" ?> method="POST">
                <div class="row">
                    <div class="col-8 col-sm-8 col-md-8">
                        <input type="hidden" name="id" value="<?php echo $intervention->getId_Intervention(); ?>">
                        <input type="hidden" name="id_app" value="<?php echo isset($_GET['id_app']) ? $_GET['id_app'] : $intervention->getId_Intervention() ?>">

                        <div class="form-group">
                            <label for="coName" class="col-md-10">Titre : *</label>
                            <div>
                                <input type="text" class="form-control" name="title" required value="<?php echo $intervention->getTitle(); ?>" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="coAcronym" class="col-md-10">Description :</label>
                            <div>
                                <textarea type="text" class="form-control" name="description" rows="10"><?php echo $intervention->getDescription(); ?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="col-4 col-sm-4 col-md-4">

                        <div class="form-group">
                            <label for="coName" class="col-md-10">Section :</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="section" value="<?php echo $intervention->getSection(); ?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="coManager" class="col-md-10">Date de début</label>
                            <div class="col-10 col-sm-10 col-md-10">
                                <input type="text" class="form-control datepicker" name="date_beg" value="<?php echo $intervention->getDate_beginning() != '0000-00-00' ? date("d/m/Y", strtotime($intervention->getDate_beginning())) : ''; ?>">
                            </div>

                        </div>

                        <div class="form-group">

                            <label for="coManager" class="col-md-10">Date de fin</label>

                            <div class="col-10 col-sm-10 col-md-10">
                                <input type="text" class="form-control datepicker" name="date_end" value="<?php echo $intervention->getDate_end() != '0000-00-00' ? date("d/m/Y", strtotime($intervention->getDate_end())) : ''; ?>">
                            </div>

                        </div>

                    </div>
                </div><!--/span-->


                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success btn-md pull-right visible-sm visible-md visible-lg">
                        <span class="glyphicon glyphicon-ok"></span> Appliquer les modifications
                    </button>
                    <button type="submit" class="btn btn-success btn-md pull-right btn-lg visible-xs">
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </div>
            </form>

            <footer>
                <hr>
                <div class="text-info text-right"> Application Lorraine Internationale Mobilité - (c) World Trade Center Metz-Saarbrücken</div>
            </footer>

        </div>

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="view/dist/js/bootstrap.min.js"></script>
        <script src="view/dist/js/offcanvas.js"></script>
        <script src="view/includes/js/autocomplete.js"></script>
        <script src="view/includes/js/bootstrap-datepicker.js"></script>
        <script src="view/includes/js/bootstrap-datepicker.fr.js"></script>
        <script type="text/javascript">
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                language: "fr",
                startView: 1,
                autoclose: true,
                todayHighlight: true
            });
        </script>
    </body>
</html>