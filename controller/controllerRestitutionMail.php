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
		$mail = $_POST['mail'];
		$vendeur = Vendeur::getVendeurByMail($mail);
		$idVendeur = $vendeur->getId();
		$lots = Lot::getLotByVendeur($idVendeur);
		$couponsLots = array();
		foreach ($lot as $lots) {
			$lot->updateStatut("Restitue");
			array_push($couponsLots, $lot->getCouponNoIncr());
		}
		header('location:../views/lotsRestitue.php?lots=' .$couponsLots);
	}

	public static function paiementLot(){
		$mail = $_POST['mail'];
		$vendeur = Vendeur::getVendeurByMail($mail);
		$idVendeur = $vendeur->getId();
		$lots = Lot::getLotByVendeur($idVendeur);
		$montant = $_POST['paiement'];
		$couponsLots = array();
		$z = 0;
		foreach ($lots as $lot) {
			if($statut === "Restitue"){
				unset($lots[$z]);
			}
			$z++;
		}
		foreach ($lots as $lot) {
			$lot->updateStatut("Paye remis");
			array_push($couponsLots, $lot->getCouponNoIncr());
		}
		header('location:../views/lotsRestitue.php?lots=' .$couponsLots. '&prixpaye=' .$montant);
	}

	public static function prepPaiementLot(){
		$mail = $_POST['mail'];
		$vendeur = Vendeur::getVendeurByMail($mail);
		$idVendeur = $vendeur->getId();
		$lots = Lot::getLotByVendeur($idVendeur);
		$numeroCheque = "Pas de numero";
		$typeDePaiement = "Liquide";
		if(isset($_POST['inputNumero'])){
			$numeroCheque = $_POST['inputNumero'];
			$typeDePaiement = "Cheque";
		}
		$lotsCopie = $lots;
		$nomVendeur = $vendeur->getNom();
		$prenomVendeur = $vendeur->getPrenom();
		$beneficiaire = $nomVendeur ." ". $prenomVendeur;
		$montant = $_POST['prepPaiement'];
		$nomEmetteur = $_POST['nomEmetteur'];
		$prenomEmetteur = $_POST['prenomEmetteur'];
		$journee = date('d/m/Y');
		$ancienFond = Caisse::getLastFond();
		$nouveauFond = $ancienFond - $montant;
		$z = 0;
		foreach ($lots as $lot) {
			$statut = $lot->getStatut();
			if($statut === "Prepaye" || $statut === "Restitue"){
				unset($lots[$z]);
			}
			$z++;
		}
		Caisse::payerLotMultiple(0, $journee,$nouveauFond,$typeDePaiement,
										 $montant,$beneficiaire,$nomEmetteur,$prenomEmetteur,
										 "0000000000","Paiement de lot vendu",
										 $lots,$numeroCheque,"Pas de commentaire");
		foreach ($lots as $lot) {
			$lot->updateStatut("Prepaye");
		}
		$_SESSION['lots'] = urlencode(serialize($lotsCopie));
		$_SESSION['vendeur'] = urlencode(serialize($vendeur));
		header('location:../views/restitutionLotMail.php');
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
