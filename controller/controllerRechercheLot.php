<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');


class ControllerRechercheLot {

	public static function rechercheLotByNum(){
		$numeroLot = $_POST['numeroLot'];
		$lot = Lot::getLotByCoupon($numeroLot);
		$listArticle = urlencode(serialize(Article::getArticlesByLot($lot->getId())));
		$a = Article::getArticlesByLot($lot->getId());
		$idForm = (String)$_POST['formEnvoie'];
		if(strcmp($idForm,"restitution")==0){
			header('location:../views/restitutionLot.php?lot='.urlencode(serialize($lot)).'&listArticle='.$listArticle);
		}
		else if(strcmp($idForm,"modification")==0){
			header('location:../views/modificationLot.php?lot='.urlencode(serialize($lot)).'&listArticle='.$listArticle);
		}
	}


}

ControllerRechercheLot::rechercheLotByNum();
//header('location:index.php');

?>
