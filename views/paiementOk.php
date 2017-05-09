<!DOCTYPE html>
<?php
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');
if(isset($_GET['coupon'])){
  $lot = Lot::getLotByCoupon($_GET['coupon']);
  $articles = Article::getArticlesByLot($lot->getId());
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Paiement validé</title>
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

  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">


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
          Vente de lot pour <?php echo $_GET['montant'] ?> €
          <small>Vous êtes sur le point de vendre un lot</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Paiement validé</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="callout callout-warning no-print">
          <h4>Le paiement a bien été enregistré et vous avez récupéré <?php echo $_GET['montant'] ?> € tous moyens de paiement confondus !</h4>
          <p>Pensez bien mettre ce montant de la caisse.</p>
        </div>

        <?php if(isset($_GET['coupon'])){ ?>
          <!-- <div class="modal"> -->
          <div class="modal-dialog no-print">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Votre numéro de coupon</h4>
                </div>
                <div class="modal-body">
                  <p style="font-size:30px">Pour rappel votre numéro de coupon: <?php echo $_GET['coupon'] ?></p>
                </div>
                <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                  <a class = "btn btn-primary" href = "../index.html" role = "button">J'ai retenu</a>

                </div>
              </div>
              <!-- /.modal-content -->
            </div>

            <!-- <div class="wrapper"> -->
            <!-- Main content -->
            <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <i class="fa fa-globe"></i> Club Hilaire
                    <small class="pull-right">Date: <?php echo date("j/m/Y"); ?></small>
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Club Hilaire, Inc.</strong><br>
                    14 Chemin du Funiculaire<br>
                    38660 Saint-Hilaire, France<br>
                    Phone: (33) 123-5432<br>
                    Email: info@clubhilaire.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $_GET['nom']." ".$_GET['prenom'] ?></strong><br>
                    Phone: <?php echo $_GET['tel'] ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Facture #<?php echo $_GET['coupon'] ?></b><br>
                  <br>
                  <b>Numero de coupon:</b> <?php echo $_GET['coupon'] ?><br>
                  <b>Date de paiement:</b> <?php echo date("j/m/Y"); ?><br>
                  <b>Compte:</b> Caisse du club Hil'Air
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Quantité</th>
                        <th>Produit</th>
                        <th>Marque / Modele</th>
                        <th>Commentaire</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $nombreArticles = sizeof($articles);
                      for ($i = 0; $i < $nombreArticles; $i++) {
                        if(!empty($articles[$i]->getTypeArticle())) {
                          $type = $articles[$i]->getLibelleTypeArticle();
                        } else if(!empty($articles[$i]->getSurfaceVoile())){
                          $type = "Voile";
                        } else {
                          $type = "";
                        }
                        if(!empty($articles[$i]->getPtvMin())) {
                          $ptvmin = $articles[$i]->getPtvMin();
                        } else {
                          $ptvmin = "";
                        }
                        if(!empty($articles[$i]->getPtvMax())) {
                          $ptvmax = $articles[$i]->getPtvMax();
                        } else {
                          $ptvmax = "";
                        }
                        if(!empty($articles[$i]->getTaille())) {
                          $taille = $articles[$i]->getTaille();
                        } else {
                          $taille = "";
                        }
                        if(!empty($articles[$i]->getAnnee())) {
                          $annee = $articles[$i]->getAnnee();
                        } else {
                          $annee = "";
                        }
                        if(!empty($articles[$i]->getSurfaceVoile())) {
                          $surfaceVoile = $articles[$i]->getSurfaceVoile();
                        } else {
                          $surfaceVoile = "";
                        }
                        if(!empty($articles[$i]->getCouleurVoile())) {
                          $couleurVoile = $articles[$i]->getCouleurVoile();
                        } else {
                          $couleurVoile = "";
                        }
                        if(!empty($articles[$i]->getHeureVoile())) {
                          $heureVoile = $articles[$i]->getHeureVoile();
                        } else {
                          $heureVoile = "";
                        }
                        if(!empty($articles[$i]->getCertificat())) {
                          $certificat = $articles[$i]->getCertificat();
                        } else {
                          $certificat = "";
                        }
                        if(!empty($articles[$i]->getTypeProtectionsellette())) {
                          $typeProtectionsellette = $articles[$i]->getTypeProtectionsellette();
                        } else {
                          $typeProtectionsellette = "";
                        }
                        if(!empty($articles[$i]->getTypeAccessoire())) {
                          $typeAccessoire = $articles[$i]->getTypeAccessoire();
                        } else {
                          $typeAccessoire = "";
                        }
                        if(!empty($articles[$i]->getMarque()->getLibelle())) {
                          $marque = $articles[$i]->getMarque()->getLibelle();
                        } else {
                          $marque = "";
                        }
                        if(!empty($articles[$i]->getModele()->getLibelle())) {
                          $modele = $articles[$i]->getModele()->getLibelle();
                        } else {
                          $modele = "";
                        }
                        if(!empty($articles[$i]->getHomologation())) {
                          $homologation = $articles[$i]->getHomologation();
                        } else {
                          $homologation = "";
                        }
                        if(!empty($articles[$i]->getCommentaire())) {
                          $commentaire = $articles[$i]->getCommentaire();
                        } else {
                          $commentaire = "";
                        } ?>
                        <tr>
                          <td>1</td>
                          <td><?php echo $type; ?></td>
                          <td><?php echo $marque." / ".$modele; ?></td>
                          <td><?php echo $commentaire; ?></td>
                          <td><?php echo ($lot->getPrix())/sizeof($articles) ?>€</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-6">
                    <p class="lead">Méthodes de paiement:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      Ceci est une facture délivrée par le Club Hil'aie dans le cadre de la coup Icare.
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-6">
                    <p class="lead">Sommes payée</p>

                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Total:</th>
                          <td><?php echo $lot->getPrix() - (20 / 100) * $lot->getPrix() ?>€</td>
                        </tr>
                        <tr>
                          <th>TVA (20%)</th>
                          <td><?php echo (20 / 100) * $lot->getPrix(); ?>€</td>
                        </tr>
                        <tr>
                          <th>Frais de port:</th>
                          <td>0€</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td><?php echo $lot->getPrix() ?>€</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- /.content -->
                <!-- </div> -->
                <!-- /.content -->
                <div class="row no-print">
                  <div class="col-xs-12">
                    <a onClick="window.print()" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                  </div>
                </div>
              </section>
              <?php } ?>
              <!-- </div> -->

            </section>
          </div>
          <footer class="main-footer no-print">
            <!-- To the right -->
            <div class="pull-right hidden-xs no-print">
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

          <!-- jQuery 2.2.3 -->
          <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
          <!-- Bootstrap 3.3.6 -->
          <script src="../bootstrap/js/bootstrap.min.js"></script>
          <!-- DataTables -->
          <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
          <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
          <!-- SlimScroll -->
          <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
          <!-- FastClick -->
          <script src="../plugins/fastclick/fastclick.js"></script>
          <!-- AdminLTE App -->
          <script src="../dist/js/app.min.js"></script>
          <!-- AdminLTE for demo purposes -->
          <script src="../dist/js/demo.js"></script>
        </body>
        </html>
