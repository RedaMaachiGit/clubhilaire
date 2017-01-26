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


class ControllerRechercheLotPreInscritpion {

		public static function rechercheLotByNum(){
			$numPre = $_POST['numPre'];
			$lot = Lot::getLotByNumPre($numPre);
			if($lot==null){
				header('location:../views/rechercheLotPreInscriptionError.html');
			}else{
				$listArticle = urlencode(serialize(Article::getArticlesByLot($lot->getId())));
				session_unset();
				$_SESSION['lot']=urlencode(serialize($lot));
				$_SESSION['articles']=$listArticle;
				header('location:../views/ajoutLotPreInscriptionParticulier.php');
			}
		}
		public static function rechercheLotByMail(){
			$email = (String) $_POST['adressePre'];
			$vendeur = Vendeur::getVendeurByMail($email);
			if($vendeur==null){
				header('location:../views/rechercheLotPreInscriptionError.html');
			}else{
				$lots = Lot::getLotByVendeur($vendeur->getId());
				session_unset();
				$_SESSION['lots']=urlencode(serialize($lots));
				header('location:../views/ajoutLotPreInscriptionEcole.php');
			}
		}
}
if($_POST['formEnvoie'] == 'preInscriptionParticulier'){
	ControllerRechercheLotPreInscritpion::rechercheLotByNum();
} else if($_POST['formEnvoie'] == 'preInscriptionEcole'){
	ControllerRechercheLotPreInscritpion::rechercheLotByMail();
} else {
	header('location:../views/rechercheLotPreInscriptionError.html');
}


?>
