<?php
session_start();
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');
include_once('../model/fraisDepot.php');
include_once('../model/fraisDepotLot.php');


class ControllerPaiementFraisDepot {
	
	public static function paiementUnique(){
		$idLot = (int)$_POST['idLot'];
		$type = $_POST['paiement'][0]['typedepaiement'];
		$nom="";
		$prenom="";
		$telephone="";
		$numero="";
		$commentaire="";		
		if($type==0){
			$type="CB";
		}else if($type==1){
			$type="Cheque";
		}else if($type==2){
			$type="espece";
		}
		$nom = (String) $_POST['paiement'][0]['inputNom'];
		$prenom = (String) $_POST['paiement'][0]['inputPrenom'];
		$telephone = (String)$_POST['paiement'][0]['inputTelephone'];
		$numero = (String) $_POST['paiement'][0]['inputNumero'];
		$commentaire = (String) $_POST['paiement'][0]['inputCommentaire'];
		$montant = $_POST['montant'];
		$fraisDepot = new FraisDepot($type,$montant,$nom,$prenom,$telephone,$numero,$commentaire);
		$fraisDepot->save();
		$lot = Lot::getLotById($idLot);
		$fraisDepotLot = new FraisDepotLot($lot,$fraisDepot);
		$fraisDepotLot->save();
		$lot->updateStatut("En vente");
		if($lot->getCouponNoIncr()==0){
			$couponIncr = $lot->getCouponIncr();
			$lot->updateCoupon($couponIncr);
			$_SESSION["coupon"]=$couponIncr;
			header('location:../views/paiementFraisDepotEffectueNumCoupon.php');
		}else{
			header('location:../views/paiementFraisDepotEffectue.php');
		}

	}
	
	public static function ajoutPaiement($i){
		$lots = unserialize(urldecode(($_POST['lots'])));
		$type = $_POST['paiement'][$i]['typedepaiement'];
		$nom="";
		$prenom="";
		$telephone="";
		$numero="";
		$commentaire="";		
		if($type==0){
			$type="CB";
		}else if($type==1){
			$type="Cheque";
		}else if($type==2){
			$type="espece";
		}
		$nom = (String) $_POST['paiement'][$i]['inputNom'];
		$prenom = (String) $_POST['paiement'][$i]['inputPrenom'];
		$telephone = (String)$_POST['paiement'][$i]['inputTelephone'];
		$numero = (String) $_POST['paiement'][$i]['inputNumero'];
		$commentaire = (String) $_POST['paiement'][$i]['inputCommentaire'];
		$montant = (int) $_POST['paiement'][$i]['inputMontant'];
		$fraisDepot = new FraisDepot($type,$montant,$nom,$prenom,$telephone,$numero,$commentaire);
		$fraisDepot->save();
		for($i=0 ; $i<=count($lots)-1; $i++){
			$fraisDepotLot = new FraisDepotLot($lots[$i],$fraisDepot);
			$fraisDepotLot->save();
			$lots[$i]->setStatut("En vente");
		}
	}
	
	public static function paiementMultiple(){
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfPaiement = $_POST['index'];
		} else {
			$numberOfPaiement = 1;
		}
		for ($i =0; $i <= $numberOfPaiement-1; $i++){		//Pour chaque article
			if(isset($_POST['paiement'][$i]['typedepaiement']) && $_POST['paiement'][$i]['typedepaiement'] >= 0 &&  $_POST['paiement'][$i]['typedepaiement'] <=2 ){
				ControllerPaiementFraisDepot::ajoutPaiement($i);
			}
		}
	}
}
	if($_POST['formEnvoie']=="unique"){
		ControllerPaiementFraisDepot::paiementUnique();
	}else{
		ControllerPaiementFraisDepot::paiementMultiple();
		header('location:../views/paiementFraisDepotEffectue.php');
	}
?>
