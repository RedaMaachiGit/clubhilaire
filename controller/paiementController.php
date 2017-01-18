<?php

	include_once('../model/lot.php');
	include_once('../model/caisse.php');
	// echo("Index of products: " . $_POST['index'] . "<br />\n");
	// echo("ID lot: " . $_POST['idLot'] . "<br />\n");
	$idLot = $_POST['idLot'];
	$MontantTotal = 0;
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
																"Vente de lot",$numCoupon,$idLot,"Pas de numéro","Pas de commentaire");
				$ecriture->save();
			} else if ($Type == 1){
				$journee = date('d/m/Y');
				$ancienFond = Caisse::getLastFond();
				$nouveauFond = $ancienFond + $Montant;
				$ecriture = new Caisse($journee,$nouveauFond,"Cheque",$Montant,
																"Caisse Club Hilaire",$Nom,$Prenom,$Telephone,
																"Vente de lot",$numCoupon,$idLot,$Numero,$Commentaire);
				$ecriture->save();
			} else if ($Type == 2){
				$journee = date('d/m/Y');
				$ancienFond = Caisse::getLastFond();
				$nouveauFond = $ancienFond + $Montant;
				$ecriture = new Caisse($journee,$nouveauFond,"Liquide",$Montant,
																"Caisse Club Hilaire",$Nom,$Prenom,$Telephone,
																"Vente de lot",$numCoupon,$idLot,"Pas de numéro","Pas de commentaire");
				$ecriture->save();
			}
			header("Location:../views/paiementOk.php?montant=".$MontantTotal);
		}
	}
?>
