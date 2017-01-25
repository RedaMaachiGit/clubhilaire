<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	 // print_r($_POST);
	session_start();
	include_once('../model/vendeur.php');
	include_once('../model/lot.php');
	include_once('../model/article.php');
	include_once('../model/modele.php');
	include_once('../model/marque.php');


class ControllerValidationLot {

	public static function validerLots(){
		if(isset($_POST['nombreLot']) && !empty($_POST['nombreLot'])){
			$nombreLot = $_POST['nombreLot'];
			$lotsvalide = array();
			$lotsinvalide = array();
			$lotvalide = array();
			$lotinvalide = array();
			for($i=0;$i<$nombreLot;$i++){
				if(isset($_POST['validation'.$i]) && !empty($_POST['validation'.$i])){
						$lot = Lot::getLotByCoupon($_POST['coupon'.$i]);
						$lot->updateStatut("En préparation");
						// $lotvalide = array("numLot" => $_POST['coupon'.$i]);
						array_push($lotsvalide, $_POST['coupon'.$i]);
				} else {
					$lot = Lot::getLotByCoupon($_POST['coupon'.$i]);
					$lot->updateStatut("Non valide");
					// $lotinvalide = array("numLot" => $_POST['coupon'.$i]);
					array_push($lotsinvalide, $_POST['coupon'.$i]);
				}
			}
			session_unset();
			$_SESSION['lotsvalide'] = $lotsvalide;
			$_SESSION['lotsinvalide'] = $lotsinvalide;
		}
		header('location:../views/lotsValides.php');
	}
}

ControllerValidationLot::validerLots();

?>
