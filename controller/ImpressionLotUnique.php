<!DOCTYPE html>
<?php


include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');


  $id = $_POST['numeroLot'];
  $objLot = new Lot();
  $lots = $objLot->getLotByCoupon($id);
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Imprimer des lots</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <style type="text/css" media="print">
      @page
      {
        size: landscape;
        margin: 2mm;  /* this affects the margin in the printer settings */
      }
  </style>
  <style>
  table {
      font-family: arial, sans-serif;
      font-size: medium;
      border-collapse: collapse;
      width: 100%;
  }

  td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
  }

  tr:nth-child(even) {
      background-color: #dddddd;
  }
  </style>

</head>

<body class="hold-transition skin-blue sidebar-mini" onload="window.print();">

    <!-- Main content -->
    <section class="content">
      <?php
        $numeroLot = $lots->getId();
        $vendeur = $lots->getVendeur();
        $prixLot = $lots->getPrix();
        $numeroLot = $lots->getId();
        $numeroCoupon = $lots->getCouponNoIncr();
        $articleObj = new Article();
        $articles = $articleObj->getArticlesByLot($numeroLot);
        $nombreArticles = sizeof($articles);
        ?>
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Ce lot contient: <?php echo $articles[0]->getLibelleTypeArticle(); if(!empty($articles[1])){ echo " ET ".$articles[1]->getLibelleTypeArticle();} else {echo "";}; ?> </h3>
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
                    <td><?php if(!empty($articles[$j]->getLibelleTypeArticle())) { echo $articles[$j]->getLibelleTypeArticle(); } else { echo "X";}?></td>
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
            <span class="info-box-text">Prix du lot</span>
            <span class="info-box-number" style="font-size:30px"><?php echo $prixLot." Euros" ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </section>
    <!-- /.content -->
</body>
</html>
