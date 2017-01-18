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
		$numeroLot = $_POST['numeroLot'];
		$lot = Lot::getLotByCoupon($numeroLot);
		if($lot==null){
			header('location:../views/recherheLotError.html');
		}else{
			$listArticle = urlencode(serialize(Article::getArticlesByLot($lot->getId())));
			$idForm = (String)$_POST['formEnvoie'];
			$_SESSION['lot']=urlencode(serialize($lot));
			$_SESSION['articles']=$listArticle;
			if(strcmp($idForm,"restitution")==0){
				header('location:../views/restitutionLot.php');
			}
			else if(strcmp($idForm,"modification")==0){
				header('location:../views/modificationLot.php');
			}
			else if(strcmp($idForm,"vente")==0){
				header('location:../views/venteLot.php');
			}
		}

	}


}

ControllerRechercheLot::rechercheLotByNum();

?>
