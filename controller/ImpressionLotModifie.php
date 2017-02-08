<?php
    include_once('../model/vendeur.php');
    include_once('../model/lot.php');
    include_once('../model/article.php');
    include_once('../model/modele.php');
    include_once('../model/marque.php');
    $id = $_GET['numeroLot'];
    $lots = Lot::getLotByCoupon($id);
    if(empty($lots)){ ?>
      <div id="timer_div">Pas de lot avec ce numéro de coupon.</div>
      <script>
          var seconds_left = 4;
          var interval = setInterval(function() {
            document.getElementById('timer_div').innerHTML = "Pas de lot avec ce numéro de coupon. Redirection dans " + --seconds_left;

            if (seconds_left <= 0)
            {
              //  document.getElementById('timer_div').innerHTML = "You are Ready!";
              window.setTimeout("location=('../views/imprimerLots.php');",0);
               clearInterval(interval);
            }
          }, 1000);
       </script>

    <?php
    return false;
    } else {
      $numeroLot = $lots->getId();
      $vendeur = $lots->getVendeur();
      $prixLot = $lots->getPrix();
      $numeroLot = $lots->getId();
      $numeroCoupon = $lots->getCouponNoIncr();
      $articles = Article::getArticlesByLot($numeroLot);
      if(!Lot::lotPossedeProduits($numeroLot)){
        $nombreArticles = 0;
      } else {
        $nombreArticles = sizeof($articles);
      }
      $vendeur = $lots->getVendeur();
      $mailVendeur = $vendeur->getEmail();
      $nom = $vendeur->getNom();
      $prenom = $vendeur->getPrenom();
      $tel = $vendeur->getTel();
      if(empty($articles[0]) || $nombreArticles == 0){
        ?>
          <div id="timer_div">Pas d'article dans ce lot.</div>
          <script>
              var seconds_left = 4;
              var interval = setInterval(function() {
                document.getElementById('timer_div').innerHTML = "Pas d'article dans ce lot. Redirection dans " + --seconds_left;

                if (seconds_left <= 0)
                {
                  //  document.getElementById('timer_div').innerHTML = "You are Ready!";
                  window.setTimeout("location=('../views/imprimerLots.php');",0);
                   clearInterval(interval);
                }
              }, 1000);
           </script>

        <?php
      }
      $principal = 0;
      for ($k = 0; $k < $nombreArticles; $k++) {
        $type = $articles[$k]->getLibelleTypeArticle();
        if(strcmp($type, "Voile") == 0){
          $principal = $k;
        }
      }

  ?>


  <body class="hold-transition skin-blue sidebar-mini" onload="window.print();">

  <div class="tg-wrap">
    <table class="tg">
    <tr>
      <th class="tg-zul5"><?php if(!empty($articles[$principal]->getLibelleTypeArticle())) { echo $articles[$principal]->getLibelleTypeArticle(); } else { echo "X";}?></th>
      <th class="tg-baqh"></th>
      <th class="tg-baqh"></th>
      <th class="tg-if35">Num coupon</th>
      <th class="tg-zul5"><?php echo $numeroCoupon; ?></th>
    </tr>
    <tr>
      <td class="tg-if35" colspan="2">Marque</td>
      <td class="tg-if35">Type</td>
      <td class="tg-if35" colspan="2">Prix</td>
    </tr>
    <tr>
      <td class="tg-0s10" colspan="2"><?php if(!empty($articles[$principal]->getMarque()->getLibelle())) { echo $articles[$principal]->getMarque()->getLibelle(); } else { echo "X";}?></td>
      <td class="tg-0s10"><?php if(!empty($articles[$principal]->getLibelleTypeArticle())) { echo $articles[$principal]->getLibelleTypeArticle(); } else { echo "X";}?></td>
      <td class="tg-0s10" colspan="2"><?php echo $prixLot; ?></td>
    </tr>
    <?php if(!empty($articles[0]->getPtvMin())) { $ptvMin = $articles[$principal]->getPtvMin(); } else {  $ptvMin = "X";}
          if(!empty($articles[0]->getPtvMax())) { $ptvMax = $articles[$principal]->getPtvMax(); } else {  $ptvMax = "X";}
          if(!empty($articles[0]->getTaille())) { $taille = $articles[$principal]->getTaille(); } else { $taille = "X";}
    ?>
    <tr>
      <td class="tg-if35" colspan="2">Modele</td>
      <td class="tg-if35">Année</td>
      <td class="tg-if35" colspan="2">Taille / PTVMin / PTVMax</td>
    </tr>
    <tr>
      <td class="tg-0s10" colspan="2"><?php if(!empty($articles[$principal]->getModele()->getLibelle())) { echo $articles[$principal]->getModele()->getLibelle(); } else { echo "X";}?></td>
      <td class="tg-0s10"><?php if(!empty($articles[$principal]->getAnnee())) { echo $articles[$principal]->getAnnee(); } else { echo "X";}?></td>
      <td class="tg-0s10" colspan="2">Taille: <?php echo $taille. " / " .$ptvMin. " / " .$ptvMax ?></td>
    </tr>
    <tr>
      <td class="tg-if35">Categorie</td>
      <td class="tg-if35">Homologation</td>
      <td class="tg-if35">Couleur</td>
      <td class="tg-if35">Heures de vol</td>
      <td class="tg-if35">Certificat</td>
    </tr>
    <tr>
      <td class="tg-0s10">Parapente</td>
      <td class="tg-0s10"><?php if(!empty($articles[$principal]->getHomologation())) { echo $articles[$principal]->getHomologation(); } else { echo "X";}?></td>
      <td class="tg-0s10"><?php if(!empty($articles[$principal]->getCouleurVoile())) { echo $articles[$principal]->getCouleurVoile(); } else { echo "X";}?></td>
      <td class="tg-0s10"><?php if(!empty($articles[$principal]->getHeureVoile())) { echo $articles[$principal]->getHeureVoile(); } else { echo "X";}?></td>
      <td class="tg-0s10"><?php if(!empty($articles[$principal]->getCertificat())) { echo $articles[$principal]->getCertificat(); } else { echo "X";}?></td>
    </tr>

    <?php
        if($nombreArticles>1){ ?>
          <tr>
            <td class="tg-wxgh" colspan="4">Articles supplémentaires dans le lot :</td>
            <td class="tg-wxgh">Commentaires</td>
          </tr>
    <?php
      }
        for ($i = 0; $i < $nombreArticles; $i++) {
          if($principal == $i){
            continue;
          }
    ?>

      <tr>
        <?php
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
      <td class="tg-yw4l" colspan="4"><?php echo $type ." de marque ".$marque ." de modele ".$modele." ".
                                                 $taille ." ".$surfaceVoile ." ".$ptvmin ." ".
                                                 $ptvmax ." ".$heureVoile ." ".
                                                 $certificat ." ".$typeProtectionSelette ." ".
                                                 $typeAccessoire ." ".$annee ." ".$homologation ." ".
                                                 $homologation; ?></td>

      <td class="tg-yw4l"><?php echo $commentaire;?></td>
    </tr>
    <?php
      }
    ?>
  </table></div>
  <div style="page-break-after:always"></div>
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
  <?php
    }
  ?>



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
  .tg  {border-collapse:collapse;border-spacing:0;}
  .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
  .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
  .tg .tg-baqh{text-align:center;vertical-align:top}
  .tg .tg-wxgh{text-decoration:underline;vertical-align:top}
  .tg .tg-zul5{font-weight:bold;font-size:28px;text-align:center;vertical-align:top}
  .tg .tg-if35{text-decoration:underline;text-align:center;vertical-align:top}
  .tg .tg-0s10{font-weight:bold;font-size:36px;text-align:center;vertical-align:top}
  .tg .tg-yw4l{vertical-align:top}
  @media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}</style>
  <style type="text/css" media="print">
      @page
      {
        size: landscape;
        margin: 2mm;  /* this affects the margin in the printer settings */
      }
  </style>
