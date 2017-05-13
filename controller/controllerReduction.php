<?php

include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');
include_once('../model/caisse.php');


class ControllerReduction {

	public static function addReductionVendeur(){
		$Idvendeur = (int)$_POST['vendeurId'];
		echo $Idvendeur;
		$reduction = $_POST['Reduction'];
		$vendeur = Vendeur::getVendeurById($Idvendeur);
		echo $vendeur->getId();
		$vendeur->updateReduction($reduction);
		header('location:../views/ReductionValider.php');
	}


}

ControllerReduction::addReductionVendeur();

?>
