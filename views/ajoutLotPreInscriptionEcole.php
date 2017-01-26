<?php
  session_start();
  include_once('../model/vendeur.php');
  include_once('../model/lot.php');
  include_once('../model/article.php');
  include_once('../model/modele.php');
  // print_r($_SESSION)
  $lots= unserialize(urldecode(($_SESSION['lots'])));
  $_SESSION['lots']=urlencode(serialize($lots));
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
  <title>Valider un lot</title>

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
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Vendeur dashboard</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Validation des lots suivants
        <!-- <small>Vous êtes sur le point de recevoir le paiement pour plusieurs lots</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vente lot</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
         $nombreTotalArticles = 0;
         for ($j = 0; $j<$nombreLots; $j++) {
         $statut = $lots[$j]->getStatut();
         if(strcmp($statut, "En préparation") != 0){
           continue;
         }
         $coupon = $lots[$j]->getCouponNoIncr();
         $idLotActuel = $lots[$j]->getId()
      ?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Ce lot numéro <?php echo $idLotActuel; ?> contient</h3>
          </div>
          <div class="box-header">
          <form id="validation" method="POST" action="../controller/controllerValidationLot.php" class="form-horizontal">
            <input type="checkbox" name="validation<?php echo $j ?>" value="<?php echo $idLotActuel."valide" ?>" checked="checked"> Valider ce lot?<br>
            <input type="hidden" name="idLot<?php echo $j ?>" id="idLot" value="<?php echo $idLotActuel ?>">
            <input type="hidden" name="nombreLot" id="nombreLot" value="<?php echo $nombreLots ?>">
            <small>Décochez cette case si vous souhaitez NE PAS valider ce lot</small>
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
                          <?php
                          $idArticle = $articles[$i]->getId();
                          if(!empty($articles[$i]->getTypeArticle())) {
                             $type = $articles[$i]->getLibelleTypeArticle();
                          } else if(!empty($articles[$i]->getSurfaceVoile())){
                             $type = "Voile";
                          } else {
                             $type = "X";
                          }
                          if(!empty($articles[$i]->getPtvMin())) {
                             $ptvmin = $articles[$i]->getPtvMin();
                          } else {
                             $ptvmin = "X";
                          }
                          if(!empty($articles[$i]->getPtvMax())) {
                             $ptvmax = $articles[$i]->getPtvMax();
                          } else {
                             $ptvmax = "X";
                          }
                          if(!empty($articles[$i]->getTaille())) {
                             $taille = $articles[$i]->getTaille();
                          } else {
                             $taille = "X";
                          }
                          if(!empty($articles[$i]->getAnnee())) {
                             $annee = $articles[$i]->getAnnee();
                          } else {
                             $annee = "X";
                          }
                          if(!empty($articles[$i]->getSurfaceVoile())) {
                             $surfaceVoile = $articles[$i]->getSurfaceVoile();
                          } else {
                             $surfaceVoile = "X";
                          }
                          if(!empty($articles[$i]->getCouleurVoile())) {
                             $couleurVoile = $articles[$i]->getCouleurVoile();
                          } else {
                             $couleurVoile = "X";
                          }
                          if(!empty($articles[$i]->getHeureVoile())) {
                             $heureVoile = $articles[$i]->getHeureVoile();
                          } else {
                             $heureVoile = "X";
                          }
                          if(!empty($articles[$i]->getCertificat())) {
                             $certificat = $articles[$i]->getCertificat();
                          } else {
                             $certificat = "X";
                          }
                          if(!empty($articles[$i]->getTypeProtectionSelette())) {
                             $typeProtectionSelette = $articles[$i]->getTypeProtectionSelette();
                          } else {
                             $typeProtectionSelette = "X";
                          }
                          if(!empty($articles[$i]->getTypeAccessoire())) {
                             $typeAccessoire = $articles[$i]->getTypeAccessoire();
                          } else {
                             $typeAccessoire = "X";
                          }
                          if(!empty($articles[$i]->getMarque()->getLibelle())) {
                             $marque = $articles[$i]->getMarque()->getLibelle();
                          } else {
                             $marque = "X";
                          }
                          if(!empty($articles[$i]->getModele()->getLibelle())) {
                             $modele = $articles[$i]->getModele()->getLibelle();
                          } else {
                             $modele = "X";
                          }
                          if(!empty($articles[$i]->getHomologation())) {
                             $homologation = $articles[$i]->getHomologation();
                          } else {
                             $homologation = "X";
                          }
                          if(!empty($articles[$i]->getCommentaire())) {
                             $commentaire = $articles[$i]->getCommentaire();
                          } else {
                             $commentaire = "X";
                          } ?>

                         <td><a href="#" <?php echo "id=\"type$nombreTotalArticles\"";?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $type ?></a></td>
                         <td><a href="#" <?php echo "id=\"pTVMinimum$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $ptvmin ?></a></td>
                         <td><a href="#" <?php echo "id=\"PTVMaximum$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $ptvmax ?></a></td>
                         <td><a href="#" <?php echo "id=\"taille$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $taille ?></a></td>
                         <td><a href="#" <?php echo "id=\"annee$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $annee ?></a></td>
                         <td><a href="#" <?php echo "id=\"surfaceVoile$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $surfaceVoile ?></a></td>
                         <td><a href="#" <?php echo "id=\"couleurVoile$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $couleurVoile ?></a></td>
                         <td><a href="#" <?php echo "id=\"heureVolesVoile$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $heureVoile ?></a></td>
                         <td><a href="#" <?php echo "id=\"certificatRevisionVoile$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $certificat ?></a></td>
                         <td><a href="#" <?php echo "id=\"typeProtectionSelette$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $typeProtectionSelette ?></a></td>
                         <td><a href="#" <?php echo "id=\"typeAccessoire$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $typeAccessoire ?></a></td>
                         <td><a href="#" <?php echo "id=\"idMarque$nombreTotalArticles\""; ?>  data-source="../controller/allMarques.php" data-type="select" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $marque ?></a></td>
                         <td><a href="#" <?php echo "id=\"idModele$nombreTotalArticles\""; ?>  data-source="../controller/allModeles.php" data-type="select" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $modele ?></a></td>
                         <td><a href="#" <?php echo "id=\"homologation$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $homologation ?></a></td>
                         <td><a href="#" <?php echo "id=\"commentaire$nombreTotalArticles\""; ?> data-type="text" data-pk="<?php echo $idArticle ?>" data-url="/../controller/changeBeforeValidation.php" data-title=""><?php echo $commentaire ?></a></td>

                        </tr>
                      <?php
                      $nombreTotalArticles ++;
                      }
                       ?>
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
      <div class="box-footer">
        <button type="submit" value="Submit" class="btn btn-info center-block">Valider</button>
      </div>
    </form>

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



<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
<script>
// document.getElementById("type").editable();

$.fn.editable.defaults.mode = 'inline';
// var dds = document.getElementsByClassName("editable-input");
// var info = function(dd) {
//   return function() {
//     alert(dd.id + ", " + dd.name);
//   }
// };
// for (var i = 0, l = dds.length; l > i; i++)
//   dds[i].onclick = info(dds[i]);

$(document).ready(function() {
  console.log(2);
  for (i = 0; i < 2; i++) {
    $("#type" + i).editable();
    $("#pTVMinimum" + i).editable();
    $("#pTVMinimum" + i).editable();
    $("#PTVMaximum" + i).editable();
    $("#taille" + i).editable();
    $("#annee" + i).editable();
    $("#surfaceVoile" + i).editable();
    $("#couleurVoile" + i).editable();
    $("#heureVolesVoile" + i).editable();
    $("#certificatRevisionVoile" + i).editable();
    $("#typeProtectionSelette" + i).editable();
    $("#typeAccessoire" + i).editable();
    $("#idMarque" + i).editable();
    $("#idModele" + i).editable();
    $("#homologation" + i).editable();
    $("#commentaire" + i).editable();
  }
});
</script>
