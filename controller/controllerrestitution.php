<?php

include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');


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
		// $ecriture =
		$lot->updateStatut("Paye au vendeur");
		header('location:../views/lotsRestitue.php?lot=' .$numeroLot);
	}


}
Controllerrestitution::restitutionLot();
?>
