<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../model/lot.php');
include_once('../model/caisse.php');

class PaiementController {

	public static function payerFraisDeDepot(){
			$lots = unserialize(urldecode(($_SESSION['lots'])));
			$fraisDepot = $_SESSION['fraisDepot'];
			session_unset();
			$nombreLots = sizeof($lots);
			$montantTotal = 0;
			if(isset($_POST['index']) && !empty($_POST['index'])) {
				$numberOfPaiement = $_POST['index'];
			} else {
				$numberOfPaiement = 0;
			}
			for ($i = 0; $i <= $numberOfPaiement; $i++) {
				if(!isset($_POST['paiement'][$i]['typedepaiement']) || !isset($_POST['paiement'][$i]['inputMontant'])){
					header("Location:../views/error.php");
				} else {
					$type = $_POST['paiement'][$i]['typedepaiement'];
					$nom = $_POST['paiement'][$i]['inputNom'];
					$prenom = $_POST['paiement'][$i]['inputPrenom'];
					$telephone = $_POST['paiement'][$i]['inputTelephone'];
					$montant = $_POST['paiement'][$i]['inputMontant'];
					$montantTotal = $montantTotal + $montant;
					if($type == 0) {
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"CB",$montant,"Caisse Club Hilaire",
												$nom,$prenom,$telephone,
												"Paiement de frais de depot",$lots,"Pas de numero","Pas de commentaire");
						$correspondanceNumsCoupons = array();
						for($j=0;$j<sizeof($lots);$j++){
							$lots[$j]->updateStatut("En attente impression");
							$idLot = $lots[$j]->getId();
							Lot::updateFicheAffiche($idLot, "NON", "NON");
							$numeroLotVendeur = $lots[$j]->getNumeroLotVendeur();
							if(sizeof($lots) == 1){
								$numCoupon = $lots[0]->getCouponNoIncr();
							}
							if(strcmp($numeroLotVendeur, "numeroLotVendeur") != 0){
								$numCoupon = $lots[$j]->getCouponNoIncr();
								$correspondanceNumsCoupons[$numeroLotVendeur] = $numCoupon;

								$_SESSION['correspondance'] = $correspondanceNumsCoupons;
							}
						}
					} else if ($type == 1){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$Numero = $_POST['paiement'][$i]['inputNumero'];
						$Commentaire = $_POST['paiement'][$i]['inputCommentaire'];
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"Cheque",$montant,"Caisse Club Hilaire",
												$nom,$prenom,$telephone,
												"Paiement de frais de depot",$lots,$Numero,$Commentaire);
						$correspondanceNumsCoupons = array();
						for($j=0;$j<sizeof($lots);$j++){
							$lots[$j]->updateStatut("En attente impression");
							$idLot = $lots[$j]->getId();
							Lot::updateFicheAffiche($idLot, "NON", "NON");
							$numeroLotVendeur = $lots[$j]->getNumeroLotVendeur();
							if(sizeof($lots) == 1){
								$numCoupon = $lots[0]->getCouponNoIncr();
							}
							if(strcmp($numeroLotVendeur, "numeroLotVendeur") != 0){
								$numCoupon = $lots[$j]->getCouponNoIncr();
								$correspondanceNumsCoupons[$numeroLotVendeur] = $numCoupon;
								// print_r($correspondanceNumsCoupons);
								$_SESSION['correspondance'] = $correspondanceNumsCoupons;
							}
						}
					} else if ($type == 2){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"Liquide",$montant,"Caisse Club Hilaire",
												$nom,$prenom,$telephone,
												"Paiement de frais de depot",$lots,"Pas de numero","Pas de commentaire");
						$correspondanceNumsCoupons = array();
						for($j=0;$j<sizeof($lots);$j++){
							$lots[$j]->updateStatut("En attente impression");
							$idLot = $lots[$j]->getId();
							Lot::updateFicheAffiche($idLot, "NON", "NON");
							$numeroLotVendeur = $lots[$j]->getNumeroLotVendeur();
							if(sizeof($lots) == 1){
								$numCoupon = $lots[0]->getCouponNoIncr();
							}
							if(strcmp($numeroLotVendeur, "numeroLotVendeur") != 0){
								$numCoupon = $lots[$j]->getCouponNoIncr();
								$correspondanceNumsCoupons[$numeroLotVendeur] = $numCoupon;
								// print_r($correspondanceNumsCoupons);
								$_SESSION['correspondance'] = $correspondanceNumsCoupons;
							}
						}
					}
				}
			}
			if(sizeof($lots) == 1){
				header("Location:../views/paiementOk.php?montant=". $montantTotal . "&coupon=" . $numCoupon);
			} else {
				header("Location:../views/paiementOk.php?montant=". $montantTotal);
			}
	}

	public static function payerFraisDeDepotUnique(){
			session_unset();
			$idLot = $_POST['idLot'];
			$lots = array();
			$lot = Lot::getLotById($idLot);
			array_push($lots, $lot);
			// print_r($_POST);
			// $fraisDepot = $_SESSION['fraisDepot'];
			$nombreLots = sizeof($lots);
			$montantTotal = 0;
			if(isset($_POST['index']) && !empty($_POST['index'])) {
				$numberOfPaiement = $_POST['index'];
			} else {
				$numberOfPaiement = 0;
			}
			for ($i = 0; $i <= $numberOfPaiement; $i++) {
				if(!isset($_POST['paiement'][$i]['typedepaiement']) || !isset($_POST['paiement'][$i]['inputMontant'])){
					header("Location:../views/error.php");
				} else {
					$type = $_POST['paiement'][$i]['typedepaiement'];
					$nom = $_POST['paiement'][$i]['inputNom'];
					$prenom = $_POST['paiement'][$i]['inputPrenom'];
					$telephone = $_POST['paiement'][$i]['inputTelephone'];
					$montant = $_POST['paiement'][$i]['inputMontant'];
					$montantTotal = $montantTotal + $montant;
					if($type == 0){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"CB",$montant,"Caisse Club Hilaire",
												$nom,$prenom,$telephone,
												"Paiement de frais de depot",$lots,"Pas de numero","Pas de commentaire");
						$lots[$i]->updateStatut("En attente impression");
						$idLot = $lots[$i]->getId();
						Lot::updateFicheAffiche($idLot, "NON", "NON");
						$numCoupon = $lot->getCouponNoIncr();
					} else if ($type == 1){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$Numero = $_POST['paiement'][$i]['inputNumero'];
						$Commentaire = $_POST['paiement'][$i]['inputCommentaire'];
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"Cheque",$montant,"Caisse Club Hilaire",
												$nom,$prenom,$telephone,
												"Paiement de frais de depot",$lots,$Numero,$Commentaire);
						$lots[$i]->updateStatut("En attente impression");
						$idLot = $lots[$i]->getId();
						Lot::updateFicheAffiche($idLot, "NON", "NON");
						$numCoupon = $lot->getCouponNoIncr();
					} else if ($type == 2){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"Liquide",$montant,"Caisse Club Hilaire",
												$nom,$prenom,$telephone,
												"Paiement de frais de depot",$lots,"Pas de numero","Pas de commentaire");
						$lots[$i]->updateStatut("En attente impression");
						$idLot = $lots[$i]->getId();
						Lot::updateFicheAffiche($idLot, "NON", "NON");
						$numCoupon = $lot->getCouponNoIncr();
					}
					header("Location:../views/paiementOk.php?montant=". $montantTotal . "&coupon=" . $numCoupon);
				}
			}
	}

	public static function payerVente(){
			session_unset();
			$montantTotal = 0;
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
					$type = $_POST['paiement'][$i]['typedepaiement'];
					$nom = $_POST['paiement'][$i]['inputNom'];
					$prenom = $_POST['paiement'][$i]['inputPrenom'];
					$telephone = $_POST['paiement'][$i]['inputTelephone'];
					$montant = $_POST['paiement'][$i]['inputMontant'];
					$montantTotal = $montantTotal + $montant;
					if($type == 0){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$ecriture = new Caisse($journee,$nouveauFond,"CB",$montant,
						"Caisse Club Hilaire",$nom,$prenom,$telephone,
						"Vente de lot","SQL","Pas de numero","Pas de commentaire");
 						$lot->updateStatut("Vendu");
						$ecriture->setLot($lot);
						$ecriture->setcoupon($numCoupon);
						$ecriture->save();
					} else if ($type == 1){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$Numero = $_POST['paiement'][$i]['inputNumero'];
						$Commentaire = $_POST['paiement'][$i]['inputCommentaire'];
						$ecriture = new Caisse($journee,$nouveauFond,"Cheque",$montant,
						"Caisse Club Hilaire",$nom,$prenom,$telephone,
						"Vente de lot","SQL",$Numero,$Commentaire);
						$lot->updateStatut("Vendu");
						$ecriture->setLot($lot);
						$ecriture->setcoupon($numCoupon);
						$ecriture->save();
					} else if ($type == 2){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$ecriture = new Caisse($journee,$nouveauFond,"Liquide",$montant,
						"Caisse Club Hilaire",$nom,$prenom,$telephone,
						"Vente de lot","SQL","Pas de numero","Pas de commentaire");
						$lot->updateStatut("Vendu");
						$ecriture->setLot($lot);
						$ecriture->setcoupon($numCoupon);
						$ecriture->save();
					}
					header("Location:../views/paiementOk.php?montant=". $montantTotal . "&coupon=" . $numCoupon.
					"&nom=".$nom."&prenom=".$prenom."&tel=".$telephone);
				}
			}
	}

	public static function payerVenteMultiple(){
			$montantTotal = 0;
			$coupons = $_POST['lots'];
			$lots = array();
			foreach($coupons as $coupon){
				$lot = Lot::getLotByCoupon($coupon);
				array_push($lots, $lot);
				$numCoupon = $lot->getCouponNoIncr(); // Recup du num coupon
			}
			if(isset($_POST['index']) && !empty($_POST['index'])) {
				$numberOfPaiement = $_POST['index'];
			} else {
				$numberOfPaiement = 0;
			}
			for ($i = 0; $i <= $numberOfPaiement; $i++) {
				if(!isset($_POST['paiement'][$i]['typedepaiement']) || !isset($_POST['paiement'][$i]['inputMontant'])){
					header("Location:../views/error.php");
				} else {
					$type = $_POST['paiement'][$i]['typedepaiement'];
					$nom = $_POST['paiement'][$i]['inputNom'];
					$prenom = $_POST['paiement'][$i]['inputPrenom'];
					$telephone = $_POST['paiement'][$i]['inputTelephone'];
					$montant = $_POST['paiement'][$i]['inputMontant'];
					$montantTotal = $montantTotal + $montant;
					if($type == 0){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						Caisse::payerLotMultiple(0, $journee,$nouveauFond,"CB",$montant,
														 "Caisse Club Hilaire",$nom,$prenom,$telephone,
														 "Vente de lot",$lots,"Pas de numero","Pas de commentaire");
						foreach ($lots as $key => $lot) {
							$lot->updateStatut("Vendu");
						}
					} else if ($type == 1){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						$Numero = $_POST['paiement'][$i]['inputNumero'];
						$Commentaire = $_POST['paiement'][$i]['inputCommentaire'];
						Caisse::payerLotMultiple(0, $journee,$nouveauFond,"Cheque",$montant,
														 "Caisse Club Hilaire",$nom,$prenom,$telephone,
														 "Vente de lot",$lots,"Pas de numero","Pas de commentaire");
						foreach ($lots as $key => $lot) {
							$lot->updateStatut("Vendu");
						}
					} else if ($type == 2){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $montant;
						Caisse::payerLotMultiple(0, $journee,$nouveauFond,"Liquide",$montant,
														 "Caisse Club Hilaire",$nom,$prenom,$telephone,
														 "Vente de lot",$lots,"Pas de numero","Pas de commentaire");
						foreach ($lots as $key => $lot) {
							$lot->updateStatut("Vendu");
						}
					}
					$_SESSION['lots'] = $lots;
					header("Location:../views/paiementOk.php?montant=". $montantTotal .
					"&nom=".$nom."&prenom=".$prenom."&tel=".$telephone);
				}
			}
	}


}
	if(isset($_POST['venteLotsMultiple'])) {
		PaiementController::payerVenteMultiple();
		return;
	}
	if(isset($_POST['multiple'])) {
		if ($_POST['multiple']=="multiple"){
			PaiementController::payerFraisDeDepot();
		}
	}
	else if (isset($_POST['paiementFraisDepotUnique'])){
		PaiementController::payerFraisDeDepotUnique();
	} else {
		PaiementController::payerVente();
	}

?>
