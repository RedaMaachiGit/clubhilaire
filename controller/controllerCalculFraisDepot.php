<?php
session_start();
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/administration.php');

class ControllerCalculFraisDepot {
	
	public static function calculFraisDepotByLot(){
		$numeroLot = $_POST['numeroLotUnique'];
		$lot = Lot::getLotByCoupon((int)$numeroLot);
		$prixLot = $lot->getPrix();
		$fraisDepot = Administration::getFraisDepotByNiveau($prixLot);
		$_SESSION['lot']=urlencode(serialize($lot));
		$_SESSION['fraisDepot']=$fraisDepot;
		header('location:../views/paiementLotUnique.php');
		
	}
	
	public static function calculFraisDepotByVendeur(){
		$email = (String) $_POST['numeroLotMultiple'];
		$vendeur = Vendeur::getVendeurByMail($email);
		$lots = Lot::getLotByVendeur($vendeur->getId());
		$totalFraisDepot=0;
		for ($i =0 ; $i <= count($lots)-1; $i++) {
			$prixLot = $lots[$i]->getPrix();
			$fraisDepotLot = Administration::getFraisDepotByNiveau($prixLot);
			$totalFraisDepot = $totalFraisDepot + $fraisDepotLot;
		}
		$_SESSION['lots']=urlencode(serialize($lots));
		$_SESSION['fraisDepot']=$totalFraisDepot;
	header('location:../views/paiementLotMultiple.php');
	}
}
	if($_POST['formEnvoie']=="unique"){
		ControllerCalculFraisDepot::calculFraisDepotByLot();
	}else{
		ControllerCalculFraisDepot::calculFraisDepotByVendeur();
	}


?>
