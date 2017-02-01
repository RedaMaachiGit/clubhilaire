<?php
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');

$lots = Lot::getLotEnAttenteImpressionStatic();
$nombreLots = sizeof($lots);
for($k=0;$k<$nombreLots;$k++){
  $numeroLot = $lots[$k]->getId();
  $vendeur = $lots[$k]->getVendeur();
  $prixLot = $lots[$k]->getPrix();
  $numeroLot = $lots[$k]->getId();
  $numeroCoupon = $lots[$k]->getCouponNoIncr();
  $vendeur = $lots[$k]->getVendeur();
  $mailVendeur = $vendeur->getEmail();
  $nom = $vendeur->getNom();
  $prenom = $vendeur->getPrenom();
  $tel = $vendeur->getTel();
  $articles = Article::getArticlesByLot($numeroLot);
  if(!Lot::lotPossedeProduits($numeroLot)){
    $nombreArticles = 0;
  } else {
    $nombreArticles = sizeof($articles);
  }
  if($numeroCoupon==-1 || empty($articles[0]) || $nombreArticles == 0){
    continue;
  }
  ?>
  <body class="hold-transition skin-blue sidebar-mini" onload="window.print();">

    <table class="tg">
      <tr>
        <th class="tg-wxgh">Nom Prénom</th>
        <th class="tg-wxgh">Téléphone</th>
        <th class="tg-wxgh" colspan="2">Num coupon</th>
        <th class="tg-wxgh" colspan="3">Prix</th>
        <th class="tg-yw4l" colspan="3">Email</th>
      </tr>
      <tr>
        <td class="tg-6k2t"><?php echo $nom ." ". $prenom; ?></td>
        <td class="tg-6k2t"><?php echo $tel; ?></td>
        <td class="tg-6k2t" colspan="2"><?php echo $numeroCoupon; ?></td>
        <td class="tg-6k2t" colspan="3"><?php echo $prixLot; ?></td>
        <td class="tg-6k2t" colspan="3"><?php echo $mailVendeur; ?></td>
      </tr>
      <tr>
        <td class="tg-wxgh">Type</td>
        <td class="tg-wxgh">Marque</td>
        <td class="tg-w0dk">Modele</td>
        <td class="tg-w0dk">Couleur</td>
        <td class="tg-w0dk">Homologation</td>
        <td class="tg-w0dk">Taille</td>
        <td class="tg-wxgh">PTV MIN/MAX</td>
        <td class="tg-wxgh">Heures de vol</td>
        <td class="tg-wxgh">Année</td>
        <td class="tg-wxgh">Commentaire</td>
      </tr>
      <?php
      for ($i = 0; $i < $nombreArticles; $i++) {
        $idArticle = $articles[$i]->getId();
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
        if(!empty($articles[$i]->getTypeProtectionSelette())) {
          $typeProtectionSelette = $articles[$i]->getTypeProtectionSelette();
        } else {
          $typeProtectionSelette = "";
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
          <td class="tg-6k2t"><?php echo $type?></td>
          <td class="tg-6k2t"><?php echo $marque?></td>
          <td class="tg-6k2t"><?php echo $modele?></td>
          <td class="tg-6k2t"><?php echo $couleurVoile?></td>
          <td class="tg-6k2t"><?php echo $homologation?></td>
          <td class="tg-6k2t"><?php echo $taille?></td>
          <td class="tg-6k2t"><?php echo $ptvmin ." / ". $ptvmax?></td>
          <td class="tg-6k2t"><?php echo $heureVoile?></td>
          <td class="tg-6k2t"><?php echo $annee?></td>
          <td class="tg-6k2t"><?php echo $commentaire?></td>
        </tr>
        <?php } ?>
        <tr>
          <td class="tg-yw4l" colspan="4">Lot rendu au vendeur (Signature vendeur)</td>
          <td class="tg-yw4l" colspan="6">Signature du vendeur au dépôt</td>
        </tr>
        <tr>
          <td class="tg-6k2t" colspan="4"><br><br><br><br></td>
          <td class="tg-6k2t" colspan="6"><br><br></td>
        </tr>
        <tr>
          <td class="tg-yw4l" colspan="4">Lot payé</td>
          <td class="tg-yw4l" colspan="6">Signature de l'acheteur</td>
        </tr>
        <tr>
          <td class="tg-6k2t" colspan="4"><br><br><br><br></td>
          <td class="tg-6k2t" colspan="6"><br><br></td>
        </tr>
      </table>
      <div style="page-break-after:always"></div>
      <?php } ?>





      <style>
      table {
        font-family: arial, sans-serif;
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
      <style type="text/css">
      .tg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;}
      .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
      .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
      .tg .tg-wxgh{text-decoration:underline;vertical-align:top}
      .tg .tg-w0dk{text-decoration:underline;text-align:right;vertical-align:top}
      .tg .tg-yw4l{vertical-align:top}
      .tg .tg-6k2t{background-color:#D2E4FC;vertical-align:top}
      </style>
      <style type="text/css" media="print">
      @page
      {
        size: landscape;
        margin: 2mm;  /* this affects the margin in the printer settings */
      }
      </style>
