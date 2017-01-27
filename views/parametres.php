<?php
  session_start();
  $params = $_SESSION['params'];
  $marge = $_SESSION['marge'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Modification de paramètres</title>
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
        Modification de paramètres
        <small>Modifiez avec précaution</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Modification params</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Modification des paramètres</h3>
        </div>
        <form id="numeroLotForm" method="POST" action="../controller/controllerParametres.php" class="form-horizontal">
          <?php for($i=0;$i<sizeof($params);$i++){ ?>
          <div class="box-body">
            <div class="col-xs-6">
              <label class="control-label" for="fraisDepotAdmin">Entrez les frais de dépôt</label>
              <div class="input-group">
                <input class="form-control input-lg" value="<?php echo $params[$i]["fraisDepotAdmin"] ?>" name="fraisDepotAdmin<?php echo $i?>" id="fraisDepotAdmin<?php echo $i?>" type="text" placeholder="Frais depot admin">
              </div>
            </div>
            <div class="col-xs-6">
              <label class="control-label" for="niveauDepotAdmin">Entrez le niveau de dépôt correspodant</label>
              <div class="input-group">
                <input class="form-control input-lg" value="<?php echo $params[$i]["niveauDepotAdmin"] ?>" name="niveauDepotAdmin<?php echo $i?>" id="niveauDepotAdmin<?php echo $i?>" type="text" placeholder="Niveau depot admin">
                <input class="form-control input-lg" name="nombreDeParams" type="hidden" id="nombreDeParams" value="<?php echo sizeof($params) ?>">
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="box-body">
            <div class="col-xs-6">
              <label class="control-label" for="fraisDepotAdmin">Entrez les frais de dépôt</label>
              <div class="input-group">
                <input class="form-control input-lg" name="newFraisDepotAdmin" id="newFraisDepotAdmin" type="text" placeholder="Frais depot admin">
              </div>
            </div>
            <div class="col-xs-6">
              <label class="control-label" for="niveauDepotAdmin">Entrez le niveau de dépôt correspodant</label>
              <div class="input-group">
                <input class="form-control input-lg" name="newNiveauDepotAdmin" id="newNiveauDepotAdmin" type="text" placeholder="Niveau depot admin">
                <input class="form-control input-lg" name="formEnvoie" type="hidden" id="formEnvoie" value="changementParams">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="col-xs-6">
              <label class="control-label" for="niveauDepotAdmin">Entrez la nouvelle marge souhaitée</label>
              <div class="input-group">
                <input class="form-control input-lg" name="newMarge" value="<?php echo $marge[0]['marge'] ?>" id="newMarge" type="text" placeholder="Marge">
                <input class="form-control input-lg" name="formEnvoie" type="hidden" id="formEnvoie" value="marge">
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" value="Submit" class="btn btn-info center-block">Valider</button>
          </div>
        </form>
        <!-- /.box-body -->
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

</body>
</html>
