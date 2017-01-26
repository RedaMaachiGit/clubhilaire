<?php

include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');
include_once('../model/caisse.php');


class Controllerrestitution {

	public static function restitutionLot(){
		$numeroLot = $_POST['numeroLot'];
		//$numeroLot = 1;
		$lot = Lot::getLotByCoupon($numeroLot);
		$lot->updateStatut("Restitue");
		header('location:../views/lotsRestitue.php?lot=' .$numeroLot);
	}

	public static function paiementLot(){
		$numeroLot = $_POST['numeroLot'];
		$lot = Lot::getLotByCoupon($numeroLot);
		$vendeur = $lot->getVendeur();
		$nomVendeur = $vendeur->getNom();
		$prenomVendeur = $vendeur->getPrenom();
		$beneficiaire = $nomVendeur ." ". $prenomVendeur;
		$montant = $_POST['paiement'];
		$Nom = $_POST['nomEmetteur'];
		$Prenom = $_POST['prenomEmetteur'];
		$journee = date('d/m/Y');
		$ancienFond = Caisse::getLastFond();
		$nouveauFond = $ancienFond - $montant;
		$ecriture = new Caisse($journee,$nouveauFond,"Liquide",$montant, $beneficiaire,$Nom,$Prenom,"0000000000",
		"Paiement de lot vendu","SQL","Pas de numéro","Pas de commentaire");
		$lot->updateStatut("Payé au vendeur");
		$ecriture->setLot($lot);
		$ecriture->setcoupon($numeroLot);
		$ecriture->save();
		header('location:../views/lotsRestitue.php?lot=' .$numeroLot. '&prixpaye=' .$montant);
	}


}
	if(isset($_POST['paiement'])){
		Controllerrestitution::paiementLot();
	} else if(isset($_POST['restitution'])){
		Controllerrestitution::restitutionLot();
	}
?>
