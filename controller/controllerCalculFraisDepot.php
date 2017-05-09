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
		$lot = Lot::getLotByCoupon($numeroLot);
		if($lot == null || !Lot::veriferPayerFraisDepot($lot->getId()) ){
			header('location:../views/paiementFraisDepotError.html');
		}else{
			$prixLot = $lot->getPrix();
			$fraisDepot = Administration::getFraisDepotByNiveau($prixLot);
			session_unset();
			$_SESSION['lot']=urlencode(serialize($lot));
			$_SESSION['fraisDepot']=$fraisDepot;
			header('location:../views/paiementLotUnique.php');
		}

	}

	public static function calculFraisDepotByNumPre(){
		$numeroPre = $_POST['numeroPre'];
		$lot = Lot::getLotByNumPre($numeroPre);
		if($lot ==null || !Lot::veriferPayerFraisDepot($lot->getId())){
			header('location:../views/paiementFraisDepotError.html');
		}else{
			$prixLot = $lot->getPrix();
			$fraisDepot = Administration::getFraisDepotByNiveau($prixLot);
			session_unset();
			$_SESSION['lot']=urlencode(serialize($lot));
			$_SESSION['fraisDepot']=$fraisDepot;
			header('location:../views/paiementLotUnique.php');
		}
	}

	public static function calculFraisDepotByVendeur(){
		$email = (String) $_POST['numeroLotMultiple'];
		$vendeur = Vendeur::getVendeurByMail($email);
		if($vendeur==null){
			header('location:../views/paiementFraisDepotError.html');
		}else{
			$idVendeur = $vendeur->getId();
			$reduction = $vendeur->getReduction();
			$lots = Lot::getLotEnPreparationByVendeur($idVendeur);
			$totalFraisDepot = 0;
			if($vendeur->getReduction() != null){
                $totalFraisDepot =  count($lots) * $vendeur->getReduction();
            }
            else{
                for ($i =0 ; $i <= count($lots)-1; $i++) {
                $prixLot = $lots[$i]->getPrix();
                $fraisDepotLot = Administration::getFraisDepotByNiveau($prixLot);
                $totalFraisDepot = $totalFraisDepot + $fraisDepotLot;
            }
            }
            session_unset();
            $_SESSION['lots'] = urlencode(serialize($lots));
            $_SESSION['fraisDepot'] = $totalFraisDepot;
			header('location:../views/paiementLotMultiple.php');
		}
	}
}
	if($_POST['formEnvoie']=="unique"){
		ControllerCalculFraisDepot::calculFraisDepotByLot();
	} else if($_POST['formEnvoie']=="uniquePre"){
		ControllerCalculFraisDepot::calculFraisDepotByNumPre();
	} else if($_POST['formEnvoie']=="multiple"){
		ControllerCalculFraisDepot::calculFraisDepotByVendeur();
	}


?>
