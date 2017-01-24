<?php
  session_start();
  include_once('../model/vendeur.php');
  include_once('../model/lot.php');
  include_once('../model/article.php');
  include_once('../model/modele.php');
  $lots= unserialize(urldecode(($_SESSION['lots'])));

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
  <title>Vendre un lot</title>
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
        Visualisation de tous les lots
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vente lot</li>
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



    </section>

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
</body>
</html>
