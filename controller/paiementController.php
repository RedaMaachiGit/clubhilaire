<?php
session_start();
include_once('../model/lot.php');
include_once('../model/caisse.php');
// echo("Index of products: " . $_POST['index'] . "<br />\n");
// echo("ID lot: " . $_POST['idLot'] . "<br />\n");
	if (isset($_POST['multiple'])){
		$lots = unserialize(urldecode(($_SESSION['lots'])));
		$fraisDepot = $_SESSION['fraisDepot'];
		$nombreLots = sizeof($lots);
		$MontantTotal = 0;
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfPaiement = $_POST['index'];
		} else {
			$numberOfPaiement = 0;
		}
		for ($i = 0; $i <= $numberOfPaiement; $i++) {
			if(!isset($_POST['paiement'][$i]['typedepaiement']) || !isset($_POST['paiement'][$i]['inputMontant'])){
				header("Location:../views/error.php");
			} else {
				$Type = $_POST['paiement'][$i]['typedepaiement'];
				$Nom = $_POST['paiement'][$i]['inputNom'];
				$Prenom = $_POST['paiement'][$i]['inputPrenom'];
				$Telephone = $_POST['paiement'][$i]['inputTelephone'];
				$Montant = $_POST['paiement'][$i]['inputMontant'];
				$MontantTotal = $MontantTotal + $Montant;
				if($Type == 0){
					$journee = date('d/m/Y');
					$ancienFond = Caisse::getLastFond();
					$nouveauFond = $ancienFond + $Montant;
					$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
											$nouveauFond,"CB",$Montant,"Caisse Club Hilaire",
											$Nom,$Prenom,$Telephone,
											"Vente de lots",$lots,"Pas de numéro","Pas de commentaire");
				} else if ($Type == 1){
					$journee = date('d/m/Y');
					$ancienFond = Caisse::getLastFond();
					$nouveauFond = $ancienFond + $Montant;
					$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
											$nouveauFond,"Cheque",$Montant,"Caisse Club Hilaire",
											$Nom,$Prenom,$Telephone,
											"Vente de lots",$lots,$Numero,$Commentaire);

				} else if ($Type == 2){
					$journee = date('d/m/Y');
					$ancienFond = Caisse::getLastFond();
					$nouveauFond = $ancienFond + $Montant;
					$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
											$nouveauFond,"Liquide",$Montant,"Caisse Club Hilaire",
											$Nom,$Prenom,$Telephone,
											"Vente de lots",$lots,"Pas de numéro","Pas de commentaire");

				}
				header("Location:../views/paiementOk.php?montant=".$MontantTotal);
			}
		}
	} else {
		$MontantTotal = 0;
		$idLot = $_POST['idLot'];
		$lot = Lot::getLotById($idLot);
		$numCoupon = $lot->getCouponNoIncr(); // Recup du num coupon
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfPaiement = $_POST['index'];
		} else {
			$numberOfPaiement = 0;
		}
		for ($i = 0; $i <= $numberOfPaiement; $i++) {
			if(!isset($_POST['paiement'][$i]['typedepaiement']) || !isset($_POST['paiement'][$i]['inputMontant'])){
				header("Location:../views/error.php");
			} else {
				$Type = $_POST['paiement'][$i]['typedepaiement'];
				$Nom = $_POST['paiement'][$i]['inputNom'];
				$Prenom = $_POST['paiement'][$i]['inputPrenom'];
				$Telephone = $_POST['paiement'][$i]['inputTelephone'];
				$Montant = $_POST['paiement'][$i]['inputMontant'];
				$MontantTotal = $MontantTotal + $Montant;
				if($Type == 0){
					$journee = date('d/m/Y');
					$ancienFond = Caisse::getLastFond();
					$nouveauFond = $ancienFond + $Montant;
					$ecriture = new Caisse($journee,$nouveauFond,"CB",$Montant,
					"Caisse Club Hilaire",$Nom,$Prenom,$Telephone,
					"Vente de lot","Pas de numéro","Pas de commentaire");
					$ecriture->setLot($lot);
					$ecriture->setcoupon($numCoupon);
					$ecriture->save();
				} else if ($Type == 1){
					$journee = date('d/m/Y');
					$ancienFond = Caisse::getLastFond();
					$nouveauFond = $ancienFond + $Montant;
					$ecriture = new Caisse($journee,$nouveauFond,"Cheque",$Montant,
					"Caisse Club Hilaire",$Nom,$Prenom,$Telephone,
					"Vente de lot",$Numero,$Commentaire);
					$ecriture->setLot($lot);
					$ecriture->setcoupon($numCoupon);
					$ecriture->save();
				} else if ($Type == 2){
					$journee = date('d/m/Y');
					$ancienFond = Caisse::getLastFond();
					$nouveauFond = $ancienFond + $Montant;
					$ecriture = new Caisse($journee,$nouveauFond,"Liquide",$Montant,
					"Caisse Club Hilaire",$Nom,$Prenom,$Telephone,
					"Vente de lot","Pas de numéro","Pas de commentaire");
					$ecriture->setLot($lot);
					$ecriture->setcoupon($numCoupon);
					$ecriture->save();
				}
				header("Location:../views/paiementOk.php?montant=".$MontantTotal);
			}
		}
	}
?>
