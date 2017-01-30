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

<link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
<?php
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');
if(isset($_POST['mail']) && !empty($_POST['mail'])){
  $mail = $_POST['mail'];
} else if(isset($_GET['mail']) && !empty($_GET['mail'])){
  $mail = $_GET['mail'];
} else if(empty($_GET['mail']) || empty($_POST['mail'])){
  ?>
  <div id="timer_div">Aucune adresse mail entrée.</div>
  <script>
  var seconds_left = 4;
  var interval = setInterval(function() {
    document.getElementById('timer_div').innerHTML = "Aucune adresse mail entrée. Redirection dans " + --seconds_left;

    if (seconds_left <= 0)
    {
      //  document.getElementById('timer_div').innerHTML = "You are Ready!";
      window.setTimeout("location=('../views/imprimerLots.html');",0);
      clearInterval(interval);
    }
  }, 1000);
  </script>

  <?php
  return false;
}

$vendeur = Vendeur::getVendeurByMail($mail);
if(empty($vendeur)){ ?>
  <div id="timer_div">Pas de vendeur avec cette adresse mail.</div>
  <script>
  var seconds_left = 4;
  var interval = setInterval(function() {
    document.getElementById('timer_div').innerHTML = "Pas de vendeur avec cette adresse mail. Redirection dans " + --seconds_left;

    if (seconds_left <= 0)
    {
      //  document.getElementById('timer_div').innerHTML = "You are Ready!";
      window.setTimeout("location=('../views/imprimerLots.html');",0);
      clearInterval(interval);
    }
  }, 1000);
  </script>

  <?php
} else {
  ?>


  <body class="hold-transition skin-blue sidebar-mini" onload="window.print();">

    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Correspondance numero lot vendeur et numero coupon
            <small class="pull-right">Date: <?php echo date("j/m/Y"); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Num Lot Vendeur</th>
                <th>Num Coupon</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                $idVendeur = $vendeur->getId();
                $lots = Lot::getLotByVendeur($idVendeur);
                $nombreLots = sizeof($lots);
                for($j=0;$j<$nombreLots;$j++){
                  $numeroLotVendeur = $lots[$j]->getNumeroLotVendeur();
                  if(strcmp($numeroLotVendeur, "numeroLotVendeur") != 0){
                    $numCoupon = $lots[$j]->getCouponNoIncr();
                    ?>
                    <td><?php echo $numCoupon; ?></td>
                    <td><?php echo $numeroLotVendeur; ?></td>
                  </tr>
            <?php
                }
              }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
    </section>
  </body>

  <?php
}
?>
