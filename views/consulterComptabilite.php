<?php
  include_once('../model/caisse.php');

  session_start();

  $numberOfOperations = $_SESSION['numberOfOperations'];
  $operations = $_SESSION['operations'];
  $fondDeCaisse = $_SESSION['fond'];
  $resultat = $_SESSION['resultat'];
  $nombreLotVendu = $_SESSION['nombreLotVendu'];
  $CB = $_SESSION['CB'];
  $Liquide = $_SESSION['Liquide'];
  $Cheque = $_SESSION['Cheque'];
?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Comptabilité</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">


  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

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
        <!-- /.search form - ->

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
          Bilan comptable
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Consultation comptabilité</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- DONUT CHART -->
        <div class="col-sm-6">
          <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Récapitulatif des paiements</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="paiement" style="height: 235px; position: relative;"></div>
          </div>
        </div>
          <!-- /.box-body -->
        </div>
        <div class="col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Fond de caisse</span>
              <span class="info-box-number"><?php echo $fondDeCaisse; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Résultat</span>
              <span class="info-box-number"><?php echo $resultat; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Nombre de lot vendus</span>
                <span class="info-box-number"><?php echo $nombreLotVendu; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="row">
          <div class="col-xs-12">


            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Détail de tous les paiement enregistrés à ce jour</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div id="example1_wrapper" class="box-body table-responsive no-padding">
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example1" class="table table-hover">
                        <thead>
                        <tr>
                          <th>Identifiant de l'opération</th>
                          <th>Lot(s)</th>
                          <th>Journée</th>
                          <th>Fond caisse après opération</th>
                          <th>Type de paiement</th>
                          <th>Montant de l'opération</th>
                          <th>Beneficiaire</th>
                          <th>Nom emetteur</th>
                          <th>Prenom emetteur</th>
                          <th>Telephone emetteur</th>
                          <th>Type transaction</th>
                          <th>Date</th>
                          <th>Numero</th>
                          <th>Commentaire</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for ($i = 0; $i < $numberOfOperations; $i++) { $idCaisse = $operations[$i]->getIdPaiement(); ?>
                        <tr>
                          <td><?php echo $idCaisse; ?></td>
                          <td><?php echo Caisse::getLotPayeString($idCaisse); ?></td>
                          <td><?php echo $operations[$i]->getJournee(); ?></td>
                          <td><?php echo $operations[$i]->getFonDeCaisse(); ?></td>
                          <td><?php echo $operations[$i]->getTypePaiement(); ?></td>
                          <td><?php echo $operations[$i]->getMontant(); ?></td>
                          <td><?php echo $operations[$i]->getBeneficiaire(); ?></td>
                          <td><?php echo $operations[$i]->getNom(); ?></td>
                          <td><?php echo $operations[$i]->getPrenom(); ?></td>
                          <td><?php echo $operations[$i]->gettelephoneEmetteur(); ?></td>
                          <td><?php echo $operations[$i]->gettypeTransaction(); ?></td>
                          <td><?php echo $operations[$i]->getdate(); ?></td>
                          <td><?php echo $operations[$i]->getNumero(); ?></td>
                          <td><?php echo $operations[$i]->getCommentaire(); ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Identifiant de l'opération</th>
                          <th>Journée</th>
                          <th>Fond caisse après opération</th>
                          <th>Type de paiement</th>
                          <th>Montant de l'opération</th>
                          <th>Beneficiaire</th>
                          <th>Nom emetteur</th>
                          <th>Prenom emetteur</th>
                          <th>Telephone emetteur</th>
                          <th>Type transaction</th>
                          <th>Date</th>
                          <th>Numero</th>
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
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.8
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </footer>
  <!-- jQuery 2.2.3 -->
  <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="../../plugins/morris/morris.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../plugins/chartjs/Chart.min.js"></script>
  <!-- FastClick -->
  <script src="../dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- page script -->

  <script>
    $(function () {
      "use strict";
      //DONUT CHART
      var donut = new Morris.Donut({
        element: 'paiement',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: [
          {label: "Paiement par CB", value: <?php echo $CB ?>},
          {label: "Paiement par chèque", value: <?php echo $Cheque ?>},
          {label: "Paiement en liquide", value: <?php echo $Liquide ?>}
        ],
        hideHover: 'auto'
      });
    });
  </script>
  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>
  </body>
  </html>
