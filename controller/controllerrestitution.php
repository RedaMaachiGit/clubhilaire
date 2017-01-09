<?php

include_once('../model/Vendeur.php');
include_once('../model/Lot.php');
include_once('../model/Article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');


class Controllerrestitution {
	
	public static function restitutionLot(){
		//$numeroLot = $_POST['numeroLot'];
		$numeroLot = 1;
		$lot = Lot::getLotByCoupon($numeroLot);
		$lot->updateStatut("Restitue");
		header('location:../index.html');
	}
	

}
Controllerrestitution::restitutionLot();
?>
