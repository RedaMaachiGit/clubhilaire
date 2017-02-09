<?php
session_start();

include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');
include_once('../model/caisse.php');


class Controllerrestitution {

	public static function restitutionLot(){
		$numeroLot = $_POST['numeroLot'];
		$lot = Lot::getLotByCoupon($numeroLot);
		$lot->updateStatut("Restitue");
		header('location:../views/lotsRestitue.php?lot=' .$numeroLot);
	}

	public static function paiementLot(){
		$numeroLot = $_POST['numeroLot'];
		$montant = $_POST['paiement'];
		$lot = Lot::getLotByCoupon($numeroLot);
		$lot->updateStatut("Paye remis");
		header('location:../views/lotsRestitue.php?lot=' .$numeroLot. '&prixpaye=' .$montant);
	}

	public static function prepPaiementLot(){
		$numeroLot = $_POST['numeroLot'];
		$numeroCheque = "Pas de numero";
		$typeDePaiement = "Liquide";
		if(isset($_POST['inputNumero'])){
			$numeroCheque = $_POST['inputNumero'];
			$typeDePaiement = "Cheque";
		}
		$articles = unserialize(urldecode($_SESSION['articles']));
		$lot = Lot::getLotByCoupon($numeroLot);
		$vendeur = $lot->getVendeur();
		$nomVendeur = $vendeur->getNom();
		$prenomVendeur = $vendeur->getPrenom();
		$beneficiaire = $nomVendeur ." ". $prenomVendeur;
		$montant = $_POST['prepPaiement'];
		$Nom = $_POST['nomEmetteur'];
		$Prenom = $_POST['prenomEmetteur'];
		$journee = date('d/m/Y');
		$ancienFond = Caisse::getLastFond();
		$nouveauFond = $ancienFond - $montant;
		$ecriture = new Caisse($journee,$nouveauFond,$typeDePaiement,$montant, $beneficiaire,$Nom,$Prenom,"0000000000",
		"Paiement de lot vendu","SQL",$numeroCheque,"Pas de commentaire");
		$lot->updateStatut("Prepaye");
		$ecriture->setLot($lot);
		$ecriture->setcoupon($numeroLot);
		$ecriture->save();
		$_SESSION['lot'] = urlencode(serialize($lot));
		$_SESSION['articles'] = urlencode(serialize($articles));
		header('location:../views/restitutionLot.php');
	}


}
	if(isset($_POST['prepPaiement'])){
		Controllerrestitution::prepPaiementLot();
	}
	else if(isset($_POST['paiement'])){
		Controllerrestitution::paiementLot();
	} else if(isset($_POST['restitution'])){
		Controllerrestitution::restitutionLot();
	}
?>
