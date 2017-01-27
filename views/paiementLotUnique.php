<?php
  session_start();
  include_once('../model/vendeur.php');
  include_once('../model/lot.php');
  include_once('../model/article.php');
  include_once('../model/modele.php');
  $lot= unserialize(urldecode(($_SESSION['lot'])));
  $fraisDepot =$_SESSION['fraisDepot'];
  $coupon = $lot->getCouponNoIncr();
  $idLotActuel = $lot->getId();
  $articles = Article::getArticlesByLot($idLotActuel);
  $nombreArticles = sizeof($articles);
  $vendeur = $lot->getVendeur();
  $prixLot = $lot->getPrix();
  $numeroLot = $lot->getId();
  $numeroCoupon = $lot->getCouponNoIncr();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Paiement lot unique</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
      <h1>
        Vente du lot numéro <?php echo $lot->getCouponNoIncr(); ?>
        <small>Vous êtes sur le point de vendre un lot</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Paiement lot unique</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Ce lot numéro <?php echo $lot->getCouponNoIncr(); ?> contient</h3>
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
                    <?php for ($j = 0; $j < $nombreArticles; $j++) { // foreach ($shop as $row) : ?>
                      <tr>
                    <td><?php if(!empty($articles[$j]->getTypeArticle())) { echo $articles[$j]->getLibelleTypeArticle(); } else if(!empty($articles[$j]->getSurfaceVoile())){echo "Voile";} else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getPtvMin())) { echo $articles[$j]->getPtvMin(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getPtvMax())) { echo $articles[$j]->getPtvMax(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getTaille())) { echo $articles[$j]->getTaille(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getAnnee())) { echo $articles[$j]->getAnnee(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getSurfaceVoile())) { echo $articles[$j]->getSurfaceVoile(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getCouleurVoile())) { echo $articles[$j]->getCouleurVoile(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getHeureVoile())) { echo $articles[$j]->getHeureVoile(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getCertificat())) { echo $articles[$j]->getCertificat(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getTypeProtectionSelette())) { echo $articles[$j]->getTypeProtectionSelette(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getTypeAccessoire())) { echo $articles[$j]->getTypeAccessoire(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getMarque()->getLibelle())) { echo $articles[$j]->getMarque()->getLibelle(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getModele()->getLibelle())) { echo $articles[$j]->getModele()->getLibelle(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getHomologation())) { echo $articles[$j]->getHomologation(); } else { echo "X";}?></td>
                    <td><?php if(!empty($articles[$j]->getCommentaire())) { echo $articles[$j]->getCommentaire(); } else { echo "X";}?></td>
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

      <div class="box box-info">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-eur"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Prix de dépôt</span>
            <span class="info-box-number" style="font-size:30px"><?php echo $fraisDepot ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>

      <div class="box box-info">
        <form id="paiementForm" class="form-horizontal" method="POST" action="../controller/paiementController.php" class="form-horizontal" onsubmit="return validateForm()">
          <div class="box-body">
            <div class="col-sm-12 form-group">
                <label>Type d'paiement</label>
                <select class="col-sm-5 form-control" id="paiement[0].inputtypedepaiement" name="paiement[0][typedepaiement]" data-index='0' onchange="handleTypeChange(this)">
                  <option value="0">Carte Bancaire</option>
                  <option value="1">Chèque</option>
                  <option value="2">Liquide</option>
                </select>
            </div>

            <input type="hidden" class="form-control" id="index" name="index" value="0" />

            <div class="form-group" name="paiement[0].nomGroup">
              <label for="inputNom" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNom" name="paiement[0][inputNom]" value="" placeholder="Nom" />
                <input class="form-control input-lg" name="paiementFraisDepotUnique" type="hidden" id="paiementFraisDepotUnique" value="paiementFraisDepotUnique">
              </div>
            </div>

            <div class="form-group" name="paiement[0].prenomGroup">
              <label for="inputPrenom" class="col-sm-2 control-label">Prénom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPrenom" name="paiement[0][inputPrenom]" value="" placeholder="Prénom" />
              </div>
            </div>

            <div class="form-group" name="paiement[0].telephoneGroup" id="paiement[0].telephoneGroup">
              <label for="inputTelephone" class="col-sm-2 control-label">Téléphone</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTelephone" name="paiement[0][inputTelephone]" value="" placeholder="Téléphone" />
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

            <input type="text" class="hidden" id="idLot" name="idLot" value="<?php echo $numeroLot ?>" />
<!--
            <div class="col-xs-1">
              <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
            </div> -->
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

function validateForm() {
  var index = document.getElementById("index").value
  var prix = "<?php echo $fraisDepot ?>";
  if(index == 0){
    var nom = document.getElementsByName("paiement[0][inputNom]");
    var prenom = document.getElementsByName("paiement[0][inputPrenom]");
    var tel = document.getElementsByName("paiement[0][inputTelephone]");
    if(nom[0].value == "" || prenom[0].value == "" || tel[0].value == ""){
      alert("Veuillez rentrez le nom, prenom ainsi que le numéro de téléphone SVP.");
      return false;
    }
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
      console.log('Prix');
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
