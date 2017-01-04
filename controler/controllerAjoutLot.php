<?php

include_once('../model/Vendeur.php');
include_once('../model/Lot.php');
include_once('../model/Article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');


class ControllerAjoutLot {

	public static function ajoutArticle($i,$lot){

		//On récupère les informations relatives à l'article
		
			/*$typeMatos = $_POST['article['+$i+'].inputtypedematos'];
			$marque = $_POST['article['+$i+'].inputmarque'];
			$modele = $_POST['article['+$i+'].inputmodele'];*/
			$typeMatos = 1;
			$marque ="marque1";
			$modele="modele1";
			
			$ptvMax ="";
			$ptvMin ="";
			$taille ="";
			$surface ="";
			$couleur ="";
			$heureDeVol ="";
			$certificat ="";
			$surface ="";
			$typeProtectionSelette=""; //A rajouter ?
			$certificat=""; //A rajouter pour le 1er
			$annee=""; //Arajouter
			$typeAccessoire="";
			if($typeMatos == 0){ // 0 correspond à une voile
				/*$ptvMax = $_POST['article['+$i+'].inputptvmax'];
				$ptvMin = $_POST['article['+$i+'].inputptvmax'];
				$taille = $_POST['article['+$i+'].inputtaille'];
				$surface = $_POST['article['+$i+'].inputsurface'];
				$couleur = $_POST['article['+$i+'].inputcouleur'];
				$heureDeVol = $_POST['article['+$i+'].inputheuresdevol'];
				$certificat = $_POST['article['+$i+'].inputcertificat'];
				$surface = $_POST['article['+$i+'].inputSurface'];*/
			}
			else if($typeMatos == 1){ //1 correspond à 
				//$taille = $_POST['article['+$i+'].inputtaille'];
			}
			else if($typeMatos == 2){ // 2 correspond à
				/*$ptvMax = $_POST['article['+$i+'].inputptvmax'];
				$ptvMin = $_POST['article['+$i+'].inputptvmax'];*/
			}
			else if($typeMatos == 3){ // 3 correspond à
				//$typeAccessoire = $_POST['article['+$i+'].inputtypeaccessoire'];
			}
			
			if(!Marque::marqueExistByLibelle($marque)){ //si la marque rentré n'existe pas
				$newMarque = new Marque($marque); //on crée la marque
				$newMarque->save();
				$newModele = new Modele($modele,"homologation",$newMarque,"categorie"); //on crée le modele
				$newModele->save();
			}else{
				$newMarque = Marque::getMarqueByLibelle($marque); //la marque existe alors on la récupère
				if(!Modele::modeleExistByLibelle($modele)){ //si le modèle n'existe pas
					$newModele = new Modele($modele,"homologation",$newMarque,"categorie"); //on crée le modèle
					$newModele->save();
				}else{
					$newModele = Modele::getModeleByLibelle($modele); //sinon on récupère le modele
				}
			}
			$article = new Article($typeMatos,$lot,$newMarque,$newModele,$ptvMax,$ptvMin,$taille,$annee,$surface,$couleur,$heureDeVol,
			$certificat,$typeProtectionSelette,$typeAccessoire,$annee,"",""); //on créer l'article correspondant et on le lie au lot.
			$article->save();
	}
	
	public static function AjouterLot(){
		
		//On Recuperer les differentes variable du formulaire ayant rapport avec le vendeur
		
		/*$nom =  "pierre";
		$prenom = "Beule";
		$tel = "0781638080";
		$email = "pierre.beule@gmail.com";
		$nbArticle = $_POST['index'];*/
		$nom = $_POST['inputNom'];
		$prenom = $_POST['inputPrenom'];
		$tel = $_POST['inputTelephone'];
		$email = $_POST['inputEmail'];
		$addresse ="3rue des ponay";
		$type = "pro";
		$numPreInscription = "";
		$cheque = 1;
		
		$numeroCoupon = "";
		$numeroLotVendeur = "numeroLotVendeur";
		$prixVente = 100;
		
		$nbArticle = 0; 
		
		if(!Vendeur::vendeurExistByMail($email)){  //L'adresse mail du vendeur de correspond à aucun vendeur en bd
			$vendeur = new Vendeur($nom,$prenom,$tel,$email,$addresse,$type,$numPreInscription,$cheque);  //On crée le vendeur
			$vendeur->save();
			echo("Levendeur n'existe pas");
		}
		else{ //L'adresse mail du vendeur correspond à un vendeur en bd
			$vendeur = Vendeur::getVendeurByMail($email); //On récupère se vendeur
		}
		$lot = new Lot($numeroCoupon,$numeroLotVendeur,$prixVente,$vendeur); //On créer le lot et on l'associe au vendeur
		$lot->save();
		
		for ($i =0; $i <= $nbArticle; $i++){		//Pour chaque article
			ControllerAjoutLot::AjoutArticle($i,$lot);
		}
	}

	
}

ControllerAjoutLot::AjouterLot();

?>