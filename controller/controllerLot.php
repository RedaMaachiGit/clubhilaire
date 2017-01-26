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
		$lots = Lot::getAllLot();
		// $listArticle = urlencode(serialize(Article::getArticlesByLot($lot->getId())));
		$_SESSION['lots']=urlencode(serialize($lots));
		// $_SESSION['articles']=$listArticle;
		header('location:../views/consulterLot.php');
	}
}

ControllerRechercheLot::rechercheLotByNum();

?>
