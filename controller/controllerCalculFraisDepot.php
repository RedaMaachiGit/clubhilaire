<?php
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/administration.php');

class ControllerPaiementFraisDepot {
	
	public static function calculFraisDepotByLot(){
		$numeroLot = $_POST['numeroLotUnique'];
		$lot = Lot::getLotByCoupon((int)$numeroLot);
		$prixLot = $lot->getPrix();
		$fraisDepot = Administration::getFraisDepotByNiveau($prixLot);
		header('location:../views/paiementLotUnique.php?lot='.urlencode(serialize($lot)).'&fraisDepot='.$fraisDepot);
		
	}
	
}

ControllerPaiementFraisDepot::calculFraisDepotByLot();
?>
