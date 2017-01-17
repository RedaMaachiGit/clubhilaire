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


class ControllerRechercheLotByNumPreInscritpion {

	public static function rechercheLotByNum(){
		$numPre = $_POST['numPre'];
		$lot = Lot::getLotByNumPre($numPre);
		if($lot==null){
			header('location:../views/rechercheLotPreInscriptionError.html');
		}else{
			$listArticle = urlencode(serialize(Article::getArticlesByLot($lot->getId())));
			$_SESSION['lot']=urlencode(serialize($lot));
			$_SESSION['articles']=$listArticle;
			header('location:../views/ajoutLotPreInscriptionParticulier.php');
		}
	}


}

ControllerRechercheLotByNumPreInscritpion::rechercheLotByNum();

?>
