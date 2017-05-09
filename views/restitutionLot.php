<?php
  session_start();

  include_once('../model/vendeur.php');
  include_once('../model/lot.php');
  include_once('../model/article.php');
  include_once('../model/modele.php');
  include_once('../model/marque.php');

  $lot= unserialize(urldecode(($_SESSION['lot'])));
  $articles = unserialize(urldecode($_SESSION['articles']));
  $nombreArticles = sizeof($articles);
  $vendeur = $lot->getVendeur();
  $prixLot = $lot->getPrix();
  $prixMarge = $lot->getPrixMoinsMarge();
  $numeroLot = $lot->getId();
  $statut = $lot->getStatut();
  $numeroCoupon = $lot->getCouponNoIncr();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Restituer un lot</title>
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
        Restitution du lot numéro <?php echo $lot->getId(); ?>
        <small>Vous êtes sur le point de restituer un lot</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../Resititution.html">Restitution</a></li>
        <li class="active">Restitution de lots</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if(strcmp($statut, "En vente") != 0){ ?>
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>ATTENTION!</strong> Ce lot numéro <?php echo $numeroCoupon ?> est indisponible à la restitution.
        </div>
      <?php } ?>
      <?php if(strcmp($statut, "Vendu") == 0){ ?>
        <div class="alert alert-warning fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>ATTENTION!</strong> Vous devez cependant payer le vendeur la somme de <?php echo $prixMarge ?>.
        </div>
        <div class="box box-info">
        <form id="paiementForm" class="form-horizontal" method="POST" action="../controller/controllerrestitution.php" class="form-horizontal">
          <div class="box-footer">
            <lable for="numeroLot"> Cliquez sur "valider paiement" une fois le paiement au vendeur effectué. La somme à payer est de <?php echo $prixMarge ?>. </label>
              <div class="col-xs-12">
                <label class="control-label" for="nomEmetteur">Entrez votre nom</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="nomEmetteur" name="nomEmetteur">
                </div>
              </div>
              <div class="col-xs-12">
                <label class="control-label" for="nomEmetteur">Entrez votre prenom</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="prenomEmetteur" name="prenomEmetteur">
                </div>
              </div>
              <input class="form-control input-lg" name="numeroLot" id="numeroLot" type="hidden" value=<?php echo $lot->getCouponNoIncr(); ?> >
              <input class="form-control input-lg" name="paiement" id="paiement" type="hidden" value=<?php echo $prixMarge ?>>
            <button type="submit" value="Submit" class="btn btn-info center-block">Valider paiement</button>
          </div>
        </form>
      </div>
      <?php } ?>

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
                    <th>Type protection sellette</th>
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
                    <td><?php if(!empty($articles[$j]->getTypeProtectionsellette())) { echo $articles[$j]->getTypeProtectionsellette(); } else { echo "X";}?></td>
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
                    <th>Type protection sellette</th>
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

      <?php if(strcmp($statut, "En vente") == 0){ ?>
      <div class="box box-info">
        <form id="paiementForm" class="form-horizontal" method="POST" action="../controller/Controllerrestitution.php" class="form-horizontal">
          <div class="box-footer">
            <!-- <button type="submit" class="btn btn-default">Annuler</button> -->
			      <input class="form-control input-lg" name="numeroLot" id="numeroLot" type="hidden" value=<?php echo $lot->getCouponNoIncr(); ?> >
            <input class="form-control input-lg" name="restitution" id="restitution" type="hidden" value="restitution">
            <button type="submit" value="Submit" class="btn btn-info center-block">Valider restitution</button>
          </div>
        </form>
      </div>
      <?php } ?>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
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

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
