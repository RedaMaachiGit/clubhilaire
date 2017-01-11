<?php
include_once('../model/coupon.php');

class ControllerModificationCoupon {


	public static function modifierCoupon(){
		$debut = $_POST['inputDebut'];
		$fin = $_POST['inputFin'];
		$current = $_POST['inputCourant'];
		if($debut > $fin || $debut < 0 || $current > $fin || $current < $debut){
			header('location:../views/numeroCoupons.html');
		} else {
			$obselete = 0;
			$coupon = new Coupon($debut,$fin,$current,$obselete);
			$coupon::updateCoupon($debut,$fin,$current,$obselete);
			header('location:../index.html');	
		}
	}
}

ControllerModificationCoupon::modifierCoupon();


?>
