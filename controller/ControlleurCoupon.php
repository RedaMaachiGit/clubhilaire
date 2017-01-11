<?php
include_once('../model/coupon.php');

class ControllerModificationCoupon {


	public static function modifierCoupon(){
		$debut = $_POST['inputDebut'];
		$fin = $_POST['inputFin'];
		$current = $_POST['inputCourant'];
		$obselete = 0;
		$coupon = new Coupon($debut,$fin,$current,$obselete);
		$coupon::updateCoupon($debut,$fin,$current,$obselete);
	}
}

ControllerModificationCoupon::modifierCoupon();
header('location:../index.html');

?>
