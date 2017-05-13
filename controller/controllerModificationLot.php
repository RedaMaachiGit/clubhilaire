<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 // print_r($_POST);
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');


class ControllerModificationLot {


	public static function modificationArticle($i,$lot,$marque,$modele){
		if(!isset($_POST['article'][$i]['inputsuppression'])){
			$ptvMax = "";
			$ptvMin = "";
			$taille = "";
			$surface = "";
			$couleur = "";
			$heuresDeVol = "";
			$certificat = "";
			$surface = "";
			$typeProtectionSelette = "";
			$annee = $_POST['article'][$i]['inputannee'];
			$typeAccessoire="";
			$typehomologation="";
			$type = $_POST['article'][$i]['typedematos'];
			if($type == 0){
				$ptvMax = $_POST['article'][$i]['inputptvmax'];
				$ptvMin = $_POST['article'][$i]['inputptvmin'];
				$taille = $_POST['article'][$i]['inputtaille'];
				$surface = $_POST['article'][$i]['inputsurface'];
				$couleur = $_POST['article'][$i]['inputcouleur'];
				$heuresDeVol = $_POST['article'][$i]['inputheuresdevol'];
				$typehomologation = $_POST['article'][$i]['typehomologation'];
				$annee = $_POST['article'][$i]['inputannee'];
				if (isset($_POST['article'][$i]['inputcertificat'])) {
					$certificat = $_POST['article'][$i]['inputcertificat'];
				}
			} else if ($type == 1){
				$taille = $_POST['article'][$i]['inputtaille'];
				$annee = $_POST['article'][$i]['inputannee'];
				$typeProtectionSelette = $_POST['article'][$i]['inputprotectionSelette'];
			} else if ($type == 2){
				$ptvMax = $_POST['article'][$i]['inputptvmax'];
				$ptvMin = $_POST['article'][$i]['inputptvmin'];
				$annee = $_POST['article'][$i]['inputannee'];
			} else if ($type == 3){
				$typeAccessoire = $_POST['article'][$i]['inputtypeaccessoire'];
				$annee = $_POST['article'][$i]['inputannee'];
			}
			$article = new Article($type,$lot,$marque,$modele,$ptvMin,$ptvMax,$taille,$surface,$couleur,$heuresDeVol,
			$certificat,$typeProtectionSelette,$typeAccessoire,$annee,"",$typehomologation);
			$article->save();
		}
	}

	public static function modifierVendeur($idVendeur){
		$nom = $_POST['inputNom'];
		$prenom = $_POST['inputPrenom'];
		$tel = $_POST['inputTelephone'];
		$email = $_POST['inputEmail'];
		$idLot = $_POST['inputLot'];
		$addresse = $_POST['inputAdresse'];
		if(isset($_POST['inputCheque'])){
			$inputCheque = $_POST['inputCheque'];
			if (strcmp($inputCheque, "Yes") == 0) {
				$cheque = 1;
			} else {
				$cheque = 0;
			}
		} else {
			$cheque = 0;
		}
		if(isset($_POST['inputPro'])){
			$inputPro = $_POST['inputPro'];
			if (strcmp($inputPro, "Yes") == 0) {
				$type = "professionnel";
			} else {
				$type = "particulier";
			}
		} else {
			$type = "particulier";
		}
		$vendeur = Vendeur::getVendeurById((int) $idVendeur);
		if(!Vendeur::vendeurExistByMail($email)){  //L'adresse mail du vendeur de correspond à aucun vendeur en bd
			$vendeur->updateMail($email);
		}
		$vendeur->updateVendeur($nom,$prenom,$addresse,$tel,$type,$cheque);
		return $vendeur;
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

	public static function modificationLot(){
		$prixVente = $_POST['inputPrix'];
		$lot= Lot::getLotById((int)$_POST['inputLot']);
		$lot->updateStatut("En attente impression");
		$idLot = $lot->getId();
		Lot::updateFicheAffiche($idLot, "NON", "NON");
		$coupon = $lot->getCouponNoIncr();
		$vendeur = ControllerModificationLot::modifierVendeur($lot->getVendeur()->getId());
		//echo "ID vendeur: " .$lot->getVendeur()->getId() . "<br>";
		$lot->updatePrix($prixVente);
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfProducts = $_POST['index'];
		} else {
			$numberOfProducts = 1;
		}
		Article::deleteArticlesByIdLot($idLot);
		for ($i =0; $i <= $numberOfProducts; $i++){		//Pour chaque article
			if(isset($_POST['article'][$i]['typedematos']) && $_POST['article'][$i]['typedematos'] >= 0 &&  $_POST['article'][$i]['typedematos'] <=3 ){
				$marque = ControllerModificationLot::ajoutMarque($i);
				$modele = ControllerModificationLot::ajoutModele($i,$marque);
				ControllerModificationLot::modificationArticle($i,$lot,$marque,$modele);
			}
		}
		header('location:../views/imprimerLots.php?numeroCoupon=' .$coupon);
	}


}

ControllerModificationLot::modificationLot();

?>
