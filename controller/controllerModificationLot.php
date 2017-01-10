<?php

include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');


class ControllerModificationLot {
	
	
	public static function modificationArticle($i,$lot,$marque,$modele){
		$ptvMax ="";
		$ptvMin ="";
		$taille ="";
		$surface ="";
		$couleur ="";
		$heuresDeVol ="";
		$certificat ="";
		$surface ="";
		$typeProtectionSelette=""; //A rajouter ?
		$annee=2000; //Arajouter
		$typeAccessoire="";
		$type = $_POST['article'][$i]['inputtypedematos'];
		if($type == 0){
			$ptvMax = $_POST['article'][$i]['inputptvmax'];
			$ptvMin = $_POST['article'][$i]['inputptvmin'];
			$taille = $_POST['article'][$i]['inputtaille'];
			$surface = $_POST['article'][$i]['inputsurface'];
			$couleur = $_POST['article'][$i]['inputcouleur'];
			$heuresDeVol = $_POST['article'][$i]['inputheuresdevol'];
			if (isset($_POST['article'][$i]['inputcertificat'])) {
				$certificat = $_POST['article'][$i]['inputcertificat'];
			}
		} else if ($type == 1){
			$Taille = $_POST['article'][$i]['inputtaille'];
		} else if ($type == 2){
			$Ptvmax = $_POST['article'][$i]['inputptvmax'];
			$Ptvmin = $_POST['article'][$i]['inputptvmin'];
		} else if ($type == 3){
			$Marque = $_POST['article'][$i]['inputmarque'];
			$typeAccessoire = $_POST['article'][$i]['inputtypeaccessoire'];
		}
		/*$article = new Article($type,$lot,$marque,$modele,$ptvMin,$ptvMax,$taille,$surface,$couleur,$heuresDeVol,
		$certificat,$typeProtectionSelette,$typeAccessoire,$annee,"","");
		$article->save();*/
	}
	
	public static function modifierVendeur($idVendeur){
		$nom = $_POST['inputNom'];
		$prenom = $_POST['inputPrenom'];
		$tel = $_POST['inputTelephone'];
		$email = $_POST['inputEmail'];
		$idVendeur = $_POST['inputLot'];
		$addresse ="3rue des ponay";
		$type = "pro";
		$cheque = 1;	
		$vendeur = Vendeur::getVendeurById((int)$idVendeur);
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
					$newModele = new Modele($modele,"homologation",$marque,"categorie"); //on crée le modèle
					$newModele->save();
				}else{
					$newModele = Modele::getModeleByLibelle($modele); //sinon on récupère le modele
				}
			return $newModele;
		}
	}
	
	public static function modificationLot(){
		$prixVente = 675;
		$lot= unserialize(urldecode(($_POST['inputLot'])));
		$vendeur = ControllerModificationLot::modifierVendeur($lot->getVendeur()->getId());
		$lot->updatePrix($prixVente);
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfProducts = $_POST['index'];
		} else {
			$numberOfProducts = 1;
		}
		//Article::deleteArticlesByIdLot($lot->getId());
		for ($i =0; $i <= $numberOfProducts-1; $i++){		//Pour chaque article
			$marque = ControllerModificationLot::ajoutMarque($i);
			$modele = ControllerModificationLot::ajoutModele($i,$marque);
			ControllerModificationLot::modificationArticle($i,$lot,$marque,$modele);
		}
	}
	

}

controllerModificationLot::modificationLot();


?>
