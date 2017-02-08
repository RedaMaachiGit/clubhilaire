<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');

class ControllerRechercheLot {

	public static function rechercheLotByNum(){
		$coupons = $_POST['lotsDisponible'];
		$lots = array();
		foreach ($coupons as $key => $coupon) {
			$lot = Lot::getLotByCoupon($coupon);
			if($lot==null){
				header('location:../views/recherheLotError.html');
			}else{
				if($lot->getStatut() === "En vente"){
					array_push($lots, $lot);
				}
			}
		}

		session_unset();
		$_SESSION['lots']=urlencode(serialize($lots));
		header('location:../views/venteLotMultiple.php');

	}


}

ControllerRechercheLot::rechercheLotByNum();

?>
