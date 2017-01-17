<?php
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
$GLOBALS['numeroCoupon'] = 'Erreur veuillez réessayer';
$GLOBALS['numeroLot'] = '';

class ControllerImpression {

	public static function imprimerTout(){
		
	}
	public static function imprimerLot($numeroLot){

	}


	public static function ajoutMarque($i){
		if (!empty($_POST['article'][$i]['inputmarque'])) {
			$marque = $_POST['article'][$i]['inputmarque'];
			if(!Marque::marqueExistByLibelle($marque)){ //si la marque rentré n'existe pas
				$newMarque = new Marque($marque); //on crée la marque
				$newMarque->save();
			}else{
				$newMarque = Marque::getMarqueByLibelle($marque); //la marque existe alors on la récupère
			}
			return $newMarque;
		}
	}

	public static function ajoutModele($i,$marque){
		if (!empty($_POST['article'][$i]['inputmodele'])) {
			$modele = $_POST['article'][$i]['inputmodele'];
			if(!Modele::modeleExistByLibelle($modele)){ //si le modèle n'existe pas
					$newModele = new Modele($modele,$marque,"categorie"); //on crée le modèle
					$newModele->save();
				}else{
					$newModele = Modele::getModeleByLibelle($modele); //sinon on récupère le modele
				}
			return $newModele;
		}
	}


	public static function ajouterLot(){
		$numeroLotVendeur = "numeroLotVendeur";
		if(!empty($_POST['inputPrix'])){
			$prixVente = $_POST['inputPrix'];
		}else{
			$prixVente = NULL;
		}
		$vendeur = ControllerAjoutLot::ajoutVendeur();
		$lot = new Lot(1,$numeroLotVendeur,$prixVente,$vendeur); //On créer le lot et on l'associe au vendeur
		$lot->save();
		$GLOBALS['numeroCoupon'] = $lot->getCouponNoIncr();
		$GLOBALS['numeroLot'] = $lot->getId();
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfProducts = $_POST['index'];
		} else {
			$numberOfProducts = 1;
		}
		for ($i =0; $i <= $numberOfProducts-1; $i++){		//Pour chaque article
			if(isset($_POST['article'][$i]['typedematos']) && $_POST['article'][$i]['typedematos'] >= 0 &&  $_POST['article'][$i]['typedematos'] <=3 ){
				$marque = ControllerAjoutLot::ajoutMarque($i);
				$modele = ControllerAjoutLot::ajoutModele($i,$marque);
				ControllerAjoutLot::AjoutArticle($i,$lot,$marque,$modele);
			}
		}
	}
}
	ControllerAjoutLot::AjouterLot();
?>
<script>
	window.top.location='../views/NumeroCoupon.php?coupon=<?php Print($GLOBALS['numeroCoupon']); ?>&numeroLot=<?php Print($GLOBALS['numeroLot']); ?>';
</script>
