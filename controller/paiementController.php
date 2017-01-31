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
					if($Type == 0) {
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $Montant;
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"CB",$Montant,"Caisse Club Hilaire",
												$Nom,$Prenom,$Telephone,
												"Paiement de frais de dépôt",$lots,"Pas de numéro","Pas de commentaire");
						$correspondanceNumsCoupons = array();
						for($j=0;$j<sizeof($lots);$j++){
							$lots[$j]->updateStatut("En vente");
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
					} else if ($Type == 1){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $Montant;
						$Numero = $_POST['paiement'][$i]['inputNumero'];
						$Commentaire = $_POST['paiement'][$i]['inputCommentaire'];
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"Cheque",$Montant,"Caisse Club Hilaire",
												$Nom,$Prenom,$Telephone,
												"Paiement de frais de dépôt",$lots,$Numero,$Commentaire);
						$correspondanceNumsCoupons = array();
						for($j=0;$j<sizeof($lots);$j++){
							$lots[$j]->updateStatut("En vente");
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
					} else if ($Type == 2){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $Montant;
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"Liquide",$Montant,"Caisse Club Hilaire",
												$Nom,$Prenom,$Telephone,
												"Paiement de frais de dépôt",$lots,"Pas de numéro","Pas de commentaire");
						$correspondanceNumsCoupons = array();
						for($j=0;$j<sizeof($lots);$j++){
							$lots[$j]->updateStatut("En vente");
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
				header("Location:../views/paiementOk.php?montant=". $MontantTotal . "&coupon=" . $numCoupon);
			} else {
				header("Location:../views/paiementOk.php?montant=". $MontantTotal);
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
												"Paiement de frais de dépôt",$lots,"Pas de numéro","Pas de commentaire");
						$lot->updateStatut("En vente");
						$numCoupon = $lot->getCouponNoIncr();
					} else if ($Type == 1){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $Montant;
						$Numero = $_POST['paiement'][$i]['inputNumero'];
						$Commentaire = $_POST['paiement'][$i]['inputCommentaire'];
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"Cheque",$Montant,"Caisse Club Hilaire",
												$Nom,$Prenom,$Telephone,
												"Paiement de frais de dépôt",$lots,$Numero,$Commentaire);
						$lot->updateStatut("En vente");
						$numCoupon = $lot->getCouponNoIncr();
					} else if ($Type == 2){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $Montant;
						$ecriture = Caisse::payerLotMultiple($nombreLots, $journee,
												$nouveauFond,"Liquide",$Montant,"Caisse Club Hilaire",
												$Nom,$Prenom,$Telephone,
												"Paiement de frais de dépôt",$lots,"Pas de numéro","Pas de commentaire");
						$lot->updateStatut("En vente");
						$numCoupon = $lot->getCouponNoIncr();
					}
					header("Location:../views/paiementOk.php?montant=". $MontantTotal . "&coupon=" . $numCoupon);
				}
			}
	}

	public static function payerVente(){
			session_unset();
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
						"Vente de lot","SQL","Pas de numéro","Pas de commentaire");
 						$lot->updateStatut("Vendu");
						$ecriture->setLot($lot);
						$ecriture->setcoupon($numCoupon);
						$ecriture->save();
					} else if ($Type == 1){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $Montant;
						$Numero = $_POST['paiement'][$i]['inputNumero'];
						$Commentaire = $_POST['paiement'][$i]['inputCommentaire'];
						$ecriture = new Caisse($journee,$nouveauFond,"Cheque",$Montant,
						"Caisse Club Hilaire",$Nom,$Prenom,$Telephone,
						"Vente de lot","SQL",$Numero,$Commentaire);
						$lot->updateStatut("Vendu");
						$ecriture->setLot($lot);
						$ecriture->setcoupon($numCoupon);
						$ecriture->save();
					} else if ($Type == 2){
						$journee = date('d/m/Y');
						$ancienFond = Caisse::getLastFond();
						$nouveauFond = $ancienFond + $Montant;
						$ecriture = new Caisse($journee,$nouveauFond,"Liquide",$Montant,
						"Caisse Club Hilaire",$Nom,$Prenom,$Telephone,
						"Vente de lot","SQL","Pas de numéro","Pas de commentaire");
						$lot->updateStatut("Vendu");
						$ecriture->setLot($lot);
						$ecriture->setcoupon($numCoupon);
						$ecriture->save();
					}
					header("Location:../views/paiementOk.php?montant=". $MontantTotal . "&coupon=" . $numCoupon.
					"&nom=".$Nom."&prenom=".$Prenom."&tel=".$Telephone);
				}
			}
	}


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
