<?php
include_once('../model/Vendeur.php');
include_once('../model/Lot.php');
include_once('../model/Article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');
class ControllerAjoutLot {

		public static function ajoutArticle($i,$lot,$marque,$modele){
			$ptvMax ="";
			$ptvMin ="";
			$taille ="";
			$surface ="";
			$couleur ="";
			$heuresDeVol ="";
			$certificat ="";
			$surface ="";
			$typeProtectionSelette=""; //A rajouter ?
			$annee=""; //Arajouter
			$typeAccessoire="";
			$type = $_POST['article'][$i]['typedematos'];
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
		$article = new Article($type,$lot,$marque,$modele,$ptvMin,$ptvMax,$taille,$surface,$couleur,$heuresDeVol,
		$certificat,$typeProtectionSelette,$typeAccessoire,$annee,"","");
		$article->save();
	}
	public static function ajoutVendeur(){
		$nom = $_POST['inputNom'];
		$prenom = $_POST['inputPrenom'];
		$tel = $_POST['inputTelephone'];
		$email = $_POST['inputEmail'];
		$addresse = $_POST['inputAdresse'];
		$type = "pro";
		$numPreInscription = "";
		$cheque = 1;
		if(!Vendeur::vendeurExistByMail($email)){  //L'adresse mail du vendeur de correspond à aucun vendeur en bd
			$vendeur = new Vendeur($nom,$prenom,$tel,$email,$addresse,$type,$numPreInscription,$cheque);  //On crée le vendeur
			$vendeur->save();
		}
		else{ //L'adresse mail du vendeur correspond à un vendeur en bd
			$vendeur = Vendeur::getVendeurByMail($email); //On récupère se vendeur
		}
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


	public static function ajouterLot(){
		$numeroCoupon = 1;
		$numeroLotVendeur = "numeroLotVendeur";
		$prixVente = $_POST['inputPrix'];;
		$vendeur = ControllerAjoutLot::ajoutVendeur();
		$lot = new Lot($numeroCoupon,$numeroLotVendeur,$prixVente,$vendeur); //On créer le lot et on l'associe au vendeur
		$lot->save();
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfProducts = $_POST['index'];
		} else {
			$numberOfProducts = 1;
		}
		for ($i =0; $i <= $numberOfProducts-1; $i++){		//Pour chaque article
			$marque = ControllerAjoutLot::ajoutMarque($i);
			$modele = ControllerAjoutLot::ajoutModele($i,$marque);
			ControllerAjoutLot::AjoutArticle($i,$lot,$marque,$modele);
		}
	}
}
ControllerAjoutLot::AjouterLot()
?>