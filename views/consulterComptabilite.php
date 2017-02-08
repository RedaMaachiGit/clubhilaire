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
$CBCumul = $_SESSION['CBCumul'];
$LiquideCumul = $_SESSION['LiquideCumul'];
$ChequeCumul = $_SESSION['ChequeCumul'];
$CBDebitCredit = $_SESSION['CBDebitCredit'];
$LiquideDebitCredit = $_SESSION['LiquideDebitCredit'];
$ChequeDebitCredit = $_SESSION['ChequeDebitCredit'];
?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript">

  window.onload = function () {
    // dataPoints
    var dataPoints1 = [];
    var dataPoints2 = [];

    var chart = new CanvasJS.Chart("chartContainer",{
      zoomEnabled: true,
      title: {
        text: ""
      },
      toolTip: {
        shared: true

      },
      legend: {
        verticalAlign: "top",
        horizontalAlign: "center",
        fontSize: 14,
        fontWeight: "bold",
        fontFamily: "calibri",
        fontColor: "dimGrey"
      },
      axisX: {
        title: "Le chiffre d'affaire et le résultat en temps réel (3s)"
      },
      axisY:{
        prefix: '€',
        includeZero: false
      },
      data: [{
        // dataSeries1
        type: "line",
        xValueType: "dateTime",
        showInLegend: true,
        name: "CA",
        dataPoints: dataPoints1
      },
      {
        // dataSeries2
        type: "line",
        xValueType: "dateTime",
        showInLegend: true,
        name: "Résultat" ,
        dataPoints: dataPoints2
      }],
      legend:{
        cursor:"pointer",
        itemclick : function(e) {
          if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          }
          else {
            e.dataSeries.visible = true;
          }
          chart.render();
        }
      }
    });



    var updateInterval = 3000;
    // initial value
    var yValue1 = <?php echo $fondDeCaisse ?>;
    var yValue2 = <?php echo $resultat ?>;



    var time = new Date;
    time.setHours(9);
    time.setMinutes(30);
    time.setSeconds(00);
    time.setMilliseconds(00);
    // starting at 9.30 am
    var ca;
    var resultat;
    var updateChart = function (count) {
      count = count || 1;

      $.ajax({
        type:"POST",
        url:"../controller/resultat.php",
        data:{action:"updateChart"},
        success:function(y){
          resultat = y;
        }
      });
      $.ajax({
        type:"POST",
        url:"../controller/ca.php",
        data:{action:"updateChart"},
        success:function(y){
          ca = y;
        }
      });

      // count is number of times loop runs to generate random dataPoints.

      for (var i = 0; i < count; i++) {

        // add interval duration to time
        time.setTime(time.getTime()+ updateInterval);
        intResultat = parseInt(resultat);
        intCa = parseInt(ca);

				var deltaY1 = <?php echo $fondDeCaisse ?>;
				var deltaY2 = <?php echo $resultat ?>;
        if (!intCa || !intResultat){
          console.log(intCa);
          deltaY1 = deltaY1 - yValue1;
          deltaY2 = deltaY2 - yValue2;
        } else {
          deltaY1 = intCa - yValue1;
          deltaY2 = intResultat - yValue2;
        }

				// adding random value and rounding it to two digits.
				yValue1 = Math.round((yValue1 + deltaY1)*100)/100;
				yValue2 = Math.round((yValue2 + deltaY2)*100)/100;

        // console.log(yValue1);
        // console.log(yValue2);
        // pushing the new values
        dataPoints1.push({
          x: time.getTime(),
          y: yValue1
        });
        dataPoints2.push({
          x: time.getTime(),
          y: yValue2
        });


      };

      // updating legend text with  updated with y Value
      chart.options.data[0].legendText = " CA €" + yValue1;
      chart.options.data[1].legendText = " Résultat €" + yValue2;

      chart.render();

    };

    // generates first set of dataPoints
    updateChart(1);

    // update chart after specified interval
    setInterval(function(){updateChart()}, updateInterval);
  }
  </script>
  <script type="text/javascript" src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Comptabilité</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="../ionicons-2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../../plugins/morris/morris.css">

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
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Bar Chart</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="bar-chart" style="height: 300px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
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
        <!-- DONUT CHART -->
        <div class="col-sm-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Récapitulatif des paiements cumulé</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chartCumul" id="paiementCumul" style="height: 235px; position: relative;"></div>
            </div>
          </div>
        </div>

        <div class="col-xs-12">
          <div class="box box-primary">
          <div id="chartContainer" style="height: 300px; width: 100%;">
          </div>
          </div>
        </div>
        <div class="col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">État de la caisse</span>
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
      <script src="../plugins/morris/morris.min.js"></script>
      <!-- FastClick -->
      <script src="../plugins/fastclick/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="../plugins/chartjs/Chart.min.js"></script>
      <!-- FastClick -->
      <script src="../dist/js/app.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="../dist/js/demo.js"></script>
      <!-- page script -->
      <!-- FLOT CHARTS -->
      <script src="../../plugins/flot/jquery.flot.min.js"></script>
      <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
      <script src="../../plugins/flot/jquery.flot.resize.min.js"></script>
      <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
      <script src="../../plugins/flot/jquery.flot.pie.min.js"></script>
      <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
      <script src="../../plugins/flot/jquery.flot.categories.min.js"></script>
      <script>
      $(function () {
        "use strict";
        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'paiementCumul',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a"],
          data: [
            {label: "Paiement par CB", value: <?php echo $CB ?>},
            {label: "Paiement par chèque", value: <?php echo $Cheque ?>},
            {label: "Paiement en liquide", value: <?php echo $Liquide ?>}
          ],
          hideHover: 'auto'
        });

        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'paiement',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a"],
          data: [
            {label: "Paiement par CB", value: <?php echo $CBCumul ?>},
            {label: "Paiement par chèque", value: <?php echo $ChequeCumul ?>},
            {label: "Paiement en liquide", value: <?php echo $LiquideCumul ?>}
          ],
          hideHover: 'auto'
        });

        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            {y: 'Carte bancaire', a: <?php echo $CBDebitCredit[0] ?>, b: <?php echo $CBDebitCredit[1] ?>},
            {y: 'Liquide', a: <?php echo $LiquideDebitCredit[0] ?>, b: <?php echo $LiquideDebitCredit[1] ?>},
            {y: 'Cheque', a: <?php echo $ChequeDebitCredit[0] ?>, b: <?php echo $ChequeDebitCredit[1] ?>}
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Débit', 'Crédit'],
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
