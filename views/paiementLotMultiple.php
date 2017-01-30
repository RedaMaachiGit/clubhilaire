<?php
  session_start();
  include_once('../model/vendeur.php');
  include_once('../model/lot.php');
  include_once('../model/article.php');
  include_once('../model/modele.php');
  $lots= unserialize(urldecode(($_SESSION['lots'])));

  $fraisDepot = $_SESSION['fraisDepot'];
  $_SESSION['lots']=urlencode(serialize($lots));
  $_SESSION['fraisDepot'] = $fraisDepot;
  if(sizeof($lots)>0){
    $vendeur = $lots[0]->getVendeur();
    $nomVendeur = $vendeur->getNom();
    $prenomVendeur = $vendeur->getPrenom();
    $telVendeur = $vendeur->getTel();
  }
  //$nombreArticles = sizeof($articles);
  $nombreLots = sizeof($lots);

  // $vendeur = $lot->getVendeur();
  // $prixLot = $lot->getPrix();
  // $numeroLot = $lot->getId();
  // $numeroCoupon = $lot->getCouponNoIncr();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Paiement lots multiples</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="../ionicons-2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="../https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="../https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="../index.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ST</b>H</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>St</b>Hilaire</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

      <!-- jQuery 2.2.3 -->
      <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
      <script>
          $(document).ready(function() {
              $('#menu').load("common/sidebar.html");
          });
      </script>
      <!-- Sidebar Menu -->
      <div id='menu' class="sidebar-menu"/>
      <!-- /.sidebar-menu -->


  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php if(sizeof($lots) == 0) { ?>
        <h1>
          Pas de lots à payer
          <small></small>
        </h1>
      <?php return false;} ?>
      <h1>
        Paiement du dépôt pour les lots suivants <?php //for($i=0; $i<count($lots)-1 ; $i++){ echo ("   ".$lots[$i]->getCoupon());}?>
        <small>Vous êtes sur le point de recevoir le paiement pour plusieurs lots</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Paiement lots multiple</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php for ($j = 0; $j < $nombreLots; $j++) { $coupon = $lots[$j]->getCouponNoIncr(); $idLotActuel = $lots[$j]->getId() ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Ce lot numéro <?php echo $coupon; ?> contient</h3>
          </div>


          <!-- /.box-header -->
          <div class="box-body">
            <div id="example1_wrapper" class="box-body table-responsive no-padding">
              <div class="row">
                <div class="col-sm-12">
                  <table id="example1" class="table table-hover">
                    <thead>
                    <tr>
                      <th>Type</th>
                      <th>PTV Minimum</th>
                      <th>PTV Maximum</th>
                      <th>Taille</th>
                      <th>Annee</th>
                      <th>Surface voile</th>
                      <th>Couleur voile</th>
                      <th>Heure voles voile</th>
                      <th>Certificat revision voile</th>
                      <th>Type protection selette</th>
                      <th>Type accessoire</th>
                      <th>MarqueIndex</th>
                      <th>Modele</th>
                      <th>Homologation</th>
                      <th>Commentaire</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                          $articles = Article::getArticlesByLot($idLotActuel);
                          $nombreArticles = sizeof($articles);

                          for ($i = 0; $i < $nombreArticles; $i++) { // foreach ($shop as $row) : ?>
                        <tr>
                      <td><?php if(!empty($articles[$i]->getTypeArticle())) { echo $articles[$i]->getLibelleTypeArticle(); } else if(!empty($articles[$i]->getSurfaceVoile())){echo "Voile";} else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getPtvMin())) { echo $articles[$i]->getPtvMin(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getPtvMax())) { echo $articles[$i]->getPtvMax(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getTaille())) { echo $articles[$i]->getTaille(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getAnnee())) { echo $articles[$i]->getAnnee(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getSurfaceVoile())) { echo $articles[$i]->getSurfaceVoile(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getCouleurVoile())) { echo $articles[$i]->getCouleurVoile(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getHeureVoile())) { echo $articles[$i]->getHeureVoile(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getCertificat())) { echo $articles[$i]->getCertificat(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getTypeProtectionSelette())) { echo $articles[$i]->getTypeProtectionSelette(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getTypeAccessoire())) { echo $articles[$i]->getTypeAccessoire(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getMarque()->getLibelle())) { echo $articles[$i]->getMarque()->getLibelle(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getModele()->getLibelle())) { echo $articles[$i]->getModele()->getLibelle(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getHomologation())) { echo $articles[$i]->getHomologation(); } else { echo "X";}?></td>
                      <td><?php if(!empty($articles[$i]->getCommentaire())) { echo $articles[$i]->getCommentaire(); } else { echo "X";}?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Type</th>
                      <th>PTV Minimum</th>
                      <th>PTV Maximum</th>
                      <th>Taille</th>
                      <th>Annee</th>
                      <th>Surface voile</th>
                      <th>Couleur voile</th>
                      <th>Heure voles voile</th>
                      <th>Certificat revision voile</th>
                      <th>Type protection selette</th>
                      <th>Type accessoire</th>
                      <th>MarqueIndex</th>
                      <th>Modele</th>
                      <th>Homologation</th>
                      <th>Commentaire</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      <?php } ?>
      <div class="box box-info">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-eur"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Prix de dépôt conseillé</span>
            <span class="info-box-number" style="font-size:30px"><?php echo $fraisDepot; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div class="box box-info">
        <form id="paiementForm" class="form-horizontal" method="POST" action="../controller/paiementController.php" class="form-horizontal" onsubmit="return validateForm()">
          <div class="box-body">
            <div class="col-sm-12 form-group">
                <label>Type de paiement</label>
                <select class="col-sm-5 form-control" id="paiement[0].inputtypedepaiement" name="paiement[0][typedepaiement]" data-index='0' onchange="handleTypeChange(this)">
                  <option value="0">Carte Bancaire</option>
                  <option value="1">Chèque</option>
                  <option value="2" selected="selected">Liquide</option>
                </select>
            </div>

            <input type="hidden" class="form-control" id="index" name="index" value="0" />
            <input type="hidden" class="form-control" id="multiple" name="multiple" value="multiple" />

            <div class="form-group" name="paiement[0].nomGroup">
              <label for="inputNom" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNom" name="paiement[0][inputNom]" value="<?php echo $nomVendeur; ?>" placeholder="Nom" />
              </div>
            </div>

            <div class="form-group" name="paiement[0].prenomGroup">
              <label for="inputPrenom" class="col-sm-2 control-label">Prénom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPrenom" name="paiement[0][inputPrenom]" value="<?php echo $prenomVendeur; ?>" placeholder="Prénom" />
              </div>
            </div>

            <div class="form-group" name="paiement[0].telephoneGroup" id="paiement[0].telephoneGroup">
              <label for="inputTelephone" class="col-sm-2 control-label">Téléphone</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTelephone" name="paiement[0][inputTelephone]" value="<?php echo $telVendeur; ?>" placeholder="Téléphone" />
              </div>
            </div>

            <div class="form-group" name="paiement[0].numeroGroup" id="paiement[0].numeroGroup" style="display:none">
              <label for="inputTelephone" class="col-sm-2 control-label">Numéro</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNumero" name="paiement[0][inputNumero]" value="" placeholder="Numéro" />
              </div>
            </div>

            <div class="form-group" name="paiement[0].commentaireGroup" id="paiement[0].commentaireGroup" style="display:none">
              <label for="inputCommentaire" class="col-sm-2 control-label">Commentaire</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputCommentaire" name="paiement[0][inputCommentaire]" value="" placeholder="Commentaire" />
              </div>
            </div>

            <div class="form-group" name="paiement[0].montantGroup" id="paiement[0].montantGroup">
              <label for="inputMontant" class="col-sm-2 control-label">Montant</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputMontant" name="paiement[0][inputMontant]" value="" placeholder="Montant" />
              </div>
            </div>



          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <!-- <button type="submit" class="btn btn-default">Annuler</button> -->
            <button type="submit" value="Submit" class="btn btn-info pull-right">Payer</button>
          </div>
        </form>
      </div>
    </section>
    <!-- /.content -->

    <div class="col-sm-12 form-group hide" id="paiementTemplate">

      <div class="col-sm-12 form-group">
          <label>Type d'paiement</label>
          <select class="col-sm-5 form-control" id="inputtypedepaiement" name="typedepaiement" data-index='0' onchange="handleTypeChange(this)">
            <option value="0">Carte Bancaire</option>
            <option value="1">Chèque</option>
            <option value="2">Liquide</option>
          </select>
      </div>

      <div class="form-group" name="nomGroup"  id="nomGroup">
        <label for="inputNom" class="col-sm-2 control-label">Nom</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputNom" name="inputNom" value="<?php echo $nomVendeur; ?>" placeholder="Nom" />
        </div>
      </div>

      <div class="form-group" name="prenomGroup" id="prenomGroup">
        <label for="inputPrenom" class="col-sm-2 control-label">Prénom</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputPrenom" name="inputPrenom" value="<?php echo $prenomVendeur; ?>" placeholder="Prénom" />
        </div>
      </div>

      <div class="form-group" name="telephone" id="telephoneGroup">
        <label for="inputTelephone" class="col-sm-2 control-label">Téléphone</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputTelephone" name="inputTelephone" value="<?php echo $telVendeur; ?>" placeholder="Téléphone" />
        </div>
      </div>

      <div class="form-group" name="numero" id="numeroGroup" style="display:none">
        <label for="inputTelephone" class="col-sm-2 control-label">Numéro</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputNumero" name="inputNumero" value="" placeholder="Numéro" />
        </div>
      </div>

      <div class="form-group" name="commentaire" id="commentaireGroup" style="display:none">
        <label for="inputCommentaire" class="col-sm-2 control-label">Commentaire</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputCommentaire" name="inputCommentaire" value="" placeholder="Commentaire" />
        </div>
      </div>

      <div class="form-group" name="montant" id="montantGroup">
        <label for="inputMontant" class="col-sm-2 control-label">Montant</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputMontant" name="inputMontant" value="" placeholder="Montant" />
        </div>
      </div>

      <div class="col-xs-1">
        <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
      </div>
    </div>



  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="https://clubsthilair.wordpress.com/">Club Hilaire</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>


<script>
var paiementIndex = 0;
var handleTypeChange = function(e) {
  console.log("Value" + e.value);
  console.log("Dataset" + e.dataset);
  console.log("Dataset index" + e.dataset.index);

  var paiementIndex = (parseInt(e.dataset.index)).toString();

  if ( e.value == '0') // Voile
  {
    console.log('TRACE CB');
    console.log(paiementIndex);
    var numerogroup = document.getElementById("paiement[" + paiementIndex + "].numeroGroup");
    numerogroup.style.display = "none";
    var commentairegroup = document.getElementById("paiement[" + paiementIndex + "].commentaireGroup");
    commentairegroup.style.display = "none";
  }
  else if ( e.value == '1') // Selette
  {
    console.log('TRACE cheque');
    console.log(paiementIndex);
    var numerogroup = document.getElementById("paiement[" + paiementIndex + "].numeroGroup");
    numerogroup.style.display = "block";
    var commentairegroup = document.getElementById("paiement[" + paiementIndex + "].commentaireGroup");
    commentairegroup.style.display = "block";
  }
  else if ( e.value == '2') // Parachute de secours
  {
    console.log('TRACE liquide');
    console.log(paiementIndex);
    var numerogroup = document.getElementById("paiement[" + paiementIndex + "].numeroGroup");
    numerogroup.style.display = "none";
    var commentairegroup = document.getElementById("paiement[" + paiementIndex + "].commentaireGroup");
    commentairegroup.style.display = "none";
  }
}
$(document).ready(function() {

    var marqueValidators = {
            row: '.col-xs-4',   // The title is placed inside a <div class="col-xs-4"> element
            validators: {
                notEmpty: {
                    message: 'La marque est requise'
                }
            }
        },
        modeleValidators = {
            row: '.col-xs-4',
            validators: {
                notEmpty: {
                    message: 'Le modele est requis'
                }
            }
        }

    $('#paiementForm')
        // .formValidation({
        //     framework: 'bootstrap',
        //     icon: {
        //         valid: 'glyphicon glyphicon-ok',
        //         invalid: 'glyphicon glyphicon-remove',
        //         validating: 'glyphicon glyphicon-refresh'
        //     },
        //     fields: {
        //         'paiement[0].marque': marqueValidators,
        //         'paiement[0].modele': modeleValidators
        //         'paiement[0].ptvmax': ptvmaxValidators
        //         'paiement[0].ptvmin': ptvminValidators
        //         'paiement[0].taille': tailleValidators
        //         'paiement[0].surface': surfaceValidators
        //         'paiement[0].couleur': couleurValidators
        //         'paiement[0].heure': heureValidators
        //         'paiement[0].typeaccessoire': typeaccessoireValidators
        //         'paiement[0].certificat': certificatValidators
        //     }
        // })

        // Add button click handler
        .on('click', '.addButton', function() {
            console.log('TRACE');
            paiementIndex++;
            console.log(paiementIndex);
            document.getElementById("index").value = paiementIndex;
            console.log(document.getElementById("index").value);
            var $form = $('#paiementForm .box-body');
            var $template = $('#paiementTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .attr('data-paiement-index', paiementIndex);
            $form.append($clone);

            // Update the name attributes
            $clone
                .find('[name="typedepaiement"]').attr('name', 'paiement[' + paiementIndex + '][typedepaiement]').end()
                .find('[name="nom"]').attr('name', 'paiement[' + paiementIndex + '].nom').end()
                .find('[name="prenom"]').attr('name', 'paiement[' + paiementIndex + '].prenom').end()
                .find('[name="telephone"]').attr('name', 'paiement[' + paiementIndex + '].telephone').end()
                .find('[name="numero"]').attr('name', 'paiement[' + paiementIndex + '].numero').end()
                .find('[name="commentaire"]').attr('name', 'paiement[' + paiementIndex + '].commentaire').end()
                .find('[name="montant"]').attr('name', 'paiement[' + paiementIndex + '].montant').end()
                // Ici on clone les identifiants
                .find('[id="inputtypedepaiement"]').attr('data-index', '' + paiementIndex).end()
                .find('[id="inputtypedepaiement"]').attr('id', 'paiement[' + paiementIndex + '].inputtypedepaiement').end()
                .find('[id="nomGroup"]').attr('id', 'paiement[' + paiementIndex + '].nomGroup').end()
                .find('[id="prenomGroup"]').attr('id', 'paiement[' + paiementIndex + '].prenomGroup').end()
                .find('[id="telephoneGroup"]').attr('id', 'paiement[' + paiementIndex + '].telephoneGroup').end()
                .find('[id="numeroGroup"]').attr('id', 'paiement[' + paiementIndex + '].numeroGroup').end()
                .find('[id="commentaireGroup"]').attr('id', 'paiement[' + paiementIndex + '].commentaireGroup').end()
                .find('[id="montantGroup"]').attr('id', 'paiement[' + paiementIndex + '].montantGroup').end()

                .find('[name="inputNom"]').attr('name', 'paiement[' + paiementIndex + '][inputNom]').end()
                .find('[name="inputPrenom"]').attr('name', 'paiement[' + paiementIndex + '][inputPrenom]').end()
                .find('[name="inputTelephone"]').attr('name', 'paiement[' + paiementIndex + '][inputTelephone]').end()
                .find('[name="inputNumero"]').attr('name', 'paiement[' + paiementIndex + '][inputNumero]').end()
                .find('[name="inputCommentaire"]').attr('name', 'paiement[' + paiementIndex + '][inputCommentaire]').end()
                .find('[name="inputMontant"]').attr('name', 'paiement[' + paiementIndex + '][inputMontant]').end()

                .find('[id="inputtypedepaiement"]').attr('id', 'paiement[' + paiementIndex + '][inputtypedepaiement]').end()
                .find('[id="inputNom"]').attr('id', 'paiement[' + paiementIndex + '][inputNom]').end()
                .find('[id="inputPrenom"]').attr('id', 'paiement[' + paiementIndex + '][inputPrenom]').end()
                .find('[id="inputTelephone"]').attr('id', 'paiement[' + paiementIndex + '][inputTelephone]').end()
                .find('[id="inputNumero"]').attr('id', 'paiement[' + paiementIndex + '][inputNumero]').end()
                .find('[id="inputCommentaire"]').attr('id', 'paiement[' + paiementIndex + '][inputCommentaire]').end()
                .find('[id="inputMontant"]').attr('id', 'paiement[' + paiementIndex + '][inputMontant]').end()

            // Add new fields
            // Note that we also pass the validator rules for new field as the third parameter
            // $('#paiementForm')
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].typedematos', typeValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].marque', marqueValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].modele', modeleValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].ptvmax', ptvmaxValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].ptvmin', ptvminValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].taille', tailleValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].surface', surfaceValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].couleur', couleurValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].heure', heureValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].typeaccessoire', typeaccessoireValidators)
            //     .formValidation('addField', 'paiement[' + paiementIndex + '].certificat', certificatValidators);

        })
        // Remove button click handler
        .on('click', '.removeButton', function() {
          paiementIndex--;
          document.getElementById("index").value = paiementIndex;
            var $row  = $(this).parents('.form-group'),
                index = $row.attr('data-paiement-index');

            // Remove fields
            // $('#paiementForm')
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].typedematos"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].marque"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].modele"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].ptvmax"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].ptvmin"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].taille"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].surface"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].couleur"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].heure"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].typeaccessoire"]'))
            //     .formValidation('removeField', $row.find('[name="paiement[' + index + '].certificat"]'));

            // Remove element containing the fields
            $row.remove();
        });

        // $(document).on('change', $('#paiement['+ paiementIndex +'].inputtypedematos'), function() {
        //     var e = document.getElementById("paiement["+ paiementIndex +"].inputtypedematos");
        //     console.log(paiementIndex);
        //
        //   });

});


function validateForm() {
  var index = document.getElementById("index").value
  var prix = "<?php echo $fraisDepot ?>";
  if(index == 0){
    // var nom = document.getElementsByName("paiement[0][inputNom]");
    // var prenom = document.getElementsByName("paiement[0][inputPrenom]");
    // var tel = document.getElementsByName("paiement[0][inputTelephone]");
    // if(nom[0].value == "" || prenom[0].value == "" || tel[0].value == ""){
    //   alert("Veuillez rentrez le nom, prenom ainsi que le numéro de téléphone SVP.");
    //   return false;
    // }
    var elem = document.getElementsByName("paiement[0][inputMontant]");
    var montant = elem[0].value;
    if(montant != prix){
      alert("ATTENTION le montant entré ne correspond pas au prix du lot");
      return false;
    }
  } else {
    var montant = 0;
    for (i = 0; i <= index; i++) {
      var nom = document.getElementsByName("paiement[" + i + "][inputNom]");
      var prenom = document.getElementsByName("paiement[" + i + "][inputPrenom]");
      var tel = document.getElementsByName("paiement[" + i + "][inputTelephone]");
      if(nom[0].value == "" || prenom[0].value == "" || tel[0].value == ""){
        alert("Veuillez rentrez le nom, prenom ainsi que le numéro de téléphone SVP.");
        return false;
      }
      var elem = document.getElementsByName("paiement[" + i + "][inputMontant]");
      montant = parseInt(montant) + parseInt(elem[0].value);
      console.log('Montant');
      console.log(montant);
      console.log('Prix lot');
      console.log(prix);
    }
    if(montant != prix){
      alert("ATTENTION la somme des montants entrés ne correspond pas au prix du lot");
      return false;
    }
  }
}
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
