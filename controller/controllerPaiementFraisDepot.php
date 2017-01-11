<?php

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
			echo "cb";
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
		$lot->setStatut("En vente");

	}
}

ControllerPaiementFraisDepot::paiementUnique();
?>
