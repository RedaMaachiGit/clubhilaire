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


class ControllerRechercheVendeur {

	public static function rechercheVendeurProByMail(){
		$mail = $_POST['mailVendeur'];
		echo $mail;
		$vendeur = Vendeur::getVendeurProByMail($mail);
		echo ($vendeur->getId());
		$_SESSION['id'] = $vendeur->getId();
		echo $vendeur->getNom();
		if($vendeur==null){
			header('location:../views/rechercheVendeurError.html');
		}else
			//$_SESSION['Vendeur']=urlencode(serialize($vendeur));
			//header('location:../views/ajoutReduction.php');
		}

	}

ControllerRechercheVendeur::rechercheVendeurProByMail();

?>
