<?php
if (!isset($people)) {
    $people = new People(array('date_born' => "0000-00-00"));
}

$tabKw = explode(',', $people->getkeyword());
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
    <body onload="initialize()">

        <?php include_once 'view/includes/header.php'; ?>

        <div class="container">

            <div class="modal fade" id="map">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Plan d'accès</h4>
                        </div>
                        <div class="modal-body">
                            <div id="map_canvas"></div>
                        </div>
                    </div>
                </div>
            </div>


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
            <?php
            setlocale(LC_ALL, 'french', 'fr_FR', 'fr_FR.ISO8859-1');
            $date = strftime("%d %B %Y", strtotime($people->getAdd_date()));
            ?>

            <?php if ($_GET['page'] == "people/show" && isset($_GET['id'])) : ?>
                <div class="pull-left"><h6>ID : <strong><?php echo $_GET['id']; ?></strong> - Ajoutée le <?php echo $date; ?></h6></div>
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
                    <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#map">
                        <span class="glyphicon glyphicon-map-marker"></span>
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
                        <a href="mailto: <?php echo $people->getEmail(); ?>">
                            <button type="button" class="btn btn-primary btn-md">
                                <span class="glyphicon glyphicon-envelope"></span> Envoyer un mail
                            </button>
                        </a>
                        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#map">
                            <span class="glyphicon glyphicon-map-marker"></span> Plan d'accès
                        </button>
                        <button type="button" class="btn btn-danger btn-md">
                            <span class="glyphicon glyphicon-trash"></span> Supprimer
                        </button>
                    </div>
                </div>


            <?php else : ?>
                <h2>Nouvelle personne</h2>
            <?php endif; ?>
            <br /><br />

            <form class="form-horizontal" action=<?php echo "index.php?page=" . $_GET['page'] . "&validate=1" ?> method="POST">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6">
                        <legend>Etat-civil</legend>
                        <input type="hidden" name="id" value="<?php echo $people->getId(); ?>">

                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="coCivilite" id="civilite2" value="2" <?php if ($people->getSexe() == 2) echo ' checked'; ?>>
                                        Madame
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="coCivilite" id="civilite1" value="1" <?php if ($people->getSexe() == 1) echo ' checked'; ?>>
                                        Monsieur
                                    </label>
                                </div>
                            </div>


                        </div>

                        <div class="form-group">
                            <label for="coName" class="col-md-10">Nom : *</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="coName" placeholder="exemple : Dupont" required value="<?php echo $people->getName(); ?>" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="coAcronym" class="col-md-10">Prénom : *</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="coFirstname" placeholder="exemple : Jean-Jacques" value="<?php echo $people->getFirstname(); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="coAddress" class="col-md-10">Adresse :</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="coAddress" placeholder="exemple : 2, rue Augustin-Fresnel" value="<?php echo $people->getAddress(); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="coCountry" class="col-md-10">Pays : *</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="coCountry" id='coCountry' placeholder="France" required value="<?php echo $people->getCountry(); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="coCp" class="col-md-12">CP : *</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id='coCp' name="coCp" placeholder="57082" required value="<?php echo $people->getZip(); ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="coCity" class="col-md-12">Ville : *</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="coCity" id='coCity' placeholder="Metz Cedex 03" required value="<?php echo $people->getCity(); ?>">
                                </div>
                            </div>
                        </div>

                        <legend>Contact</legend>

                        <div class="form-group">
                            <div class="input-group col-md-10">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Téléphone" name="coPhone" value="<?php echo $people->getPhone(); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group col-md-10">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="text" class="form-control" placeholder="E-mail" name="coMail" value="<?php echo $people->getEmail(); ?>">
                            </div>
                        </div>



                    </div><!--/span-->


                    <div class="col-6 col-sm-6 col-md-6">

                        <legend>Autre informations</legend>


                        <div class="form-group">      

                            <label for="coManager" class="col-md-10">Nationalité :</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="coNationality" value="<?php echo $people->getNationality(); ?>">
                            </div> 
                        </div>


                        <div class="form-group">

                            <label for="coManager" class="col-md-10">Date de naissance :</label>

                            <div class="col-4 col-sm-4 col-md-4">
                                <input type="text" class="form-control datepicker" name="coBorn" value="<?php echo $people->getDate_born() != '0000-00-00' ? date("d/m/Y", strtotime($people->getDate_born())) : ''; ?>">
                            </div>

                        </div>

                        <br /><br />
                        <div class="col-md-10 well">
                            <legend>Mots-clefs</legend>
                            <div id="keyword">
                                <div class="form-group">
                                    <div class="col-xs-11">
                                        <input type="text" class="form-control" name="kw1" id="inputkw1" placeholder="Mot-clef" value="<?php echo $tabKw[0]; ?>">
                                        <input type="hidden" class="form-control" id="countKw" value = <?php echo sizeof($tabKw); ?>>
                                    </div>
                                    <button type="button" class="close delkw" onclick="$('#inputkw1').val('')">&times;</button>
                                </div>
                                <?php for ($i = 2; $i <= sizeof($tabKw); $i++) : ?>
                                    <div class="form-group" id="<?php echo "kw" . $i; ?>">
                                        <div class="col-xs-11">
                                            <input type="text" class="form-control" id="<?php echo "inputkw" . $i; ?>" name="<?php echo "kw" . $i; ?>" placeholder="Mot-clef" value="<?php echo $tabKw[$i - 1]; ?>">
                                        </div>
                                        <button type="button" class="close delkw" onclick="hidekw('<?php echo $i; ?>')">&times;</button>
                                    </div>
                                <?php endfor; ?>

                            </div>

                            <div class="col-xs-offset-10">
                                <button type="button" class="btn btn-info btn-md" id="addKw"
                                        data-content="Vous pouvez ajouter jusqu'à 10 mots-clefs. Les champs vides ne seront pas pris en compte au moment de l'ajout dans la base.">
                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                </button>
                            </div>
                        </div>
                    </div><!--/span-->


                </div>



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
                                            startView: 2,
                                            language: "fr",
                                            autoclose: true,
                                            todayHighlight: true
                                        });

                                        function hidekw(idkw) {
                                            $('#kw' + idkw).hide();
                                            $("input[name=kw" + idkw + "]").val('');
                                            for (var i = parseInt(idkw) + 1; i <= (nKw); i++) {
                                                $("#inputkw" + i).attr("name", "kw" + (i - 1));
                                            }
                                            nKw--;
                                            $("#addKw").show();
                                        }

                                        $(function() {
                                            $("input[name=coManager]").popover({placement: 'right', trigger: 'focus', container: 'body'});
                                            $("#addKw").popover({placement: 'right', trigger: 'hover', container: 'body'});
                                        });

                                        nKw = $("#countKw").val();
                                        $("#addKw").click(function() {
                                            nKw++;
                                            $("#keyword").append('<div class="form-group" id="kw' + nKw + '">'
                                                    + '<div class="col-xs-11">'
                                                    + '<input type="text" class="form-control" id="inputkw' + nKw + '" name="kw' + nKw + '" placeholder="Mot-clef">'
                                                    + '</div>'
                                                    + '<button type="button" class="close delkw" name="del' + nKw + '" id="' + nKw + '" onclick= hidekw("' + nKw + '")>&times;</button>'
                                                    + '</div>');
                                            if (nKw > 9)
                                                $("#addKw").hide();
                                        });

                                        if (nKw > 9) {
                                            $("#addKw").hide();
                                        }
        </script>





        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh3MgYmitfIzC6ZzyWNGkhJg0QrhBfhd0&sensor=false">
        </script>

        <script type="text/javascript">
            var geocoder;
            var map;
            var address = $("input[name=coAddress]").val() + ' '
                    + $("input[name=coCp]").val() + ' '
                    + $("input[name=coCity]").val() + ', '
                    + $("input[name=coCountry]").val();

            function initialize() {
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(-34.397, 150.644);
                var myOptions = {
                    zoom: 16,
                    center: latlng,
                    mapTypeControl: true,
                    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                    navigationControl: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                if (geocoder) {
                    geocoder.geocode({'address': address}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                                map.setCenter(results[0].geometry.location);

                                var infowindow = new google.maps.InfoWindow(
                                        {content: '<b>' + address + '</b>',
                                            size: new google.maps.Size(150, 50)
                                        });

                                var marker = new google.maps.Marker({
                                    position: results[0].geometry.location,
                                    map: map,
                                    title: address
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                    infowindow.open(map, marker);
                                });

                            }
                        }
                    });
                }

                $('#map').on('shown.bs.modal', function() {
                    var currentCenter = map.getCenter();
                    google.maps.event.trigger(map, "resize");
                    map.setCenter(currentCenter);
                });
                google.maps.event.addDomListener(window, 'load', initialize);
            }

        </script>

    </body>
</html>