<?php
  if(isset($_GET['numeroCoupon'])) {
    $coupon = $_GET['numeroCoupon'];
  } else {
    $coupon = "";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Imprimer des lots</title>
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

  <link rel="stylesheet" href="../jquery-ui-1.12.1/jquery-ui.css">
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
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Imprimer un ou des lots
      <small>Vous pouvez imprimez des lots</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="../index.html"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Impression</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-6" >
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">S'il s'agit d'une impression pour un seul lot : veuillez saisir le numéro du lot</h3>
          </div>
          <form target="_blank" id="numeroLotForm" method="POST" action="../controller/ImpressionLotUnique.php" class="form-horizontal">
            <div class="box-body">
              <input class="form-control input-lg" name="numeroLot"  type="text" id="numeroLot" placeholder="Numéro lot" value="<?php echo $coupon; ?>">
              <div class="box-footer">
                <button type="submit" value="Submit" class="btn btn-info center-block">Imprimer affiche</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6" >
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">S'il s'agit d'une impression pour un seul lot : veuillez saisir le numéro du lot</h3>
          </div>
          <form target="_blank" id="numeroLotForm" method="POST" action="../controller/ImpressionBenevoleLotUnique.php" class="form-horizontal">
            <div class="box-body">
              <input class="form-control input-lg" name="numeroLot"  type="text" id="numeroLot" placeholder="Numéro lot" value="<?php echo $coupon; ?>">
              <div class="box-footer">
                <button type="submit" value="Submit" class="btn btn-info center-block">Imprimer fiche bénévole</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6" >
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">S'il s'agit d'une impresion pour plusieurs lots : veuillez saisir l'email du vendeur</h3>
          </div>
          <form target="_blank" id="numeroLotForm" method="POST" action="../controller/ImpressionMail.php" class="form-horizontal">
            <div class="box-body">
              <input class="autocMail" name="mail"  id="mail" type="text" placeholder="Email vendeur">
              <div class="box-footer">
                <button type="submit" value="Submit" class="btn btn-info center-block">Imprimer affiche</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6" >
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">S'il s'agit d'une impresion pour plusieurs lots : veuillez saisir l'email du vendeur</h3>
          </div>
          <form target="_blank" id="numeroLotForm" method="POST" action="../controller/ImpressionBenevoleMail.php" class="form-horizontal">
            <div class="box-body">
              <input class="autocMail" name="mail"  id="mail" type="text" placeholder="Email vendeur">
              <div class="box-footer">
                <button type="submit" value="Submit" class="btn btn-info center-block">Imprimer fiche bénévole</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-12" >
        <div class="callout callout-danger">
                  <h4>Warning!</h4>

                  <p>L'impression de tous les lots est assez longue, soyez sûr de ce que vous faites.</p>
        </div>
      </div>

      <div class="col-md-6" >
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Pour imprimer tous les lots</h3>
          </div>
          <form target="_blank" id="numeroLotForm" method="POST" action="../controller/Impression.php" class="form-horizontal">
            <div class="box-body">
  			      <input class="form-control input-lg" name="formEnvoie" type="hidden" id="formEnvoie" value="multiple">
                <button type="submit" value="Submit" class="btn btn-info center-block">Imprimer affiches</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-6" >
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Pour imprimer tous les lots</h3>
          </div>
          <form target="_blank" id="numeroLotForm" method="POST" action="../controller/ImpressionBenevoles.php" class="form-horizontal">
            <div class="box-body">
  			      <input class="form-control input-lg" name="formEnvoie" type="hidden" id="formEnvoie" value="multiple">
                <button type="submit" value="Submit" class="btn btn-info center-block">Imprimer fiches bénévoles</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>


</div>


<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../jquery-ui-1.12.1/jquery-ui.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<script>
$('.autocMail').autocomplete({
       minLength: 2,
       source: '../controller/automail.php'
});
$('.autocMail').addClass('form-control input-lg').removeClass('autocMail');

</script>
</body>
</html>
