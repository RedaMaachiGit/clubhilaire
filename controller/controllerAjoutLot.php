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
		// echo("First name: " . $_POST['inputNom'] . "<br />\n"); //TRACE
		// echo("Last name: " . $_POST['inputPrenom'] . "<br />\n"); //TRACE
		// echo("Phone: " . $_POST['inputTelephone'] . "<br />\n"); //TRACE
		// echo("Email: " . $_POST['inputEmail'] . "<br />\n"); //TRACE

		$nom = $_POST['inputNom'];
		$prenom = $_POST['inputPrenom'];
		$tel = $_POST['inputTelephone'];
		$email = $_POST['inputEmail'];
		$adressePostale = $_POST['inputAdresse'];
		$prixLot = $_POST['inputPrix'];

		// echo("Index of products: " . $_POST['index'] . "<br />\n"); //TRACE
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfProducts = $_POST['index'];
		} else {
			$numberOfProducts = 1;
		}
		for ($index = 0; $index <= $numberOfProducts-1; $index++) {
			$Type = $_POST['article'][$index][typedematos];
			$Marque = $_POST['article'][$index][inputmarque];
			$Modele = $_POST['article'][$index][inputmodele];
			$Ptvmax = $_POST['article'][$index][inputptvmax];
			$Ptvmin = $_POST['article'][$index][inputptvmin];
			$Taille = $_POST['article'][$index][inputtaille];
			$Surface = $_POST['article'][$index][inputsurface];
			$Couleur = $_POST['article'][$index][inputcouleur];
			$Heuresdevol = $_POST['article'][$index][inputheuresdevol];
			$ProtectionSelette = $_POST['article'][$index][inputprotectionSelette];
			$Certificat = $_POST['article'][$index][inputcertificat];
			$Typeaccessoire = $_POST['article'][$index][inputtypeaccessoire];

			if($Type == 0){
				echo("Il s'agit d'une voile<br />\n"); //TRACE
				echo("Marque: " . $Marque . "<br />\n"); //TRACE
				echo("Modele: " . $Modele . "<br />\n"); //TRACE
				echo("Ptvmax: " . $Ptvmax . "<br />\n"); //TRACE
				echo("Ptvmin: " . $Ptvmin . "<br />\n"); //TRACE
				echo("Taille: " . $Taille . "<br />\n"); //TRACE
				echo("Surface: " . $Surface . "<br />\n"); //TRACE
				echo("Couleur: " . $Couleur . "<br />\n"); //TRACE
				echo("Heures de vol: " . $Heuresdevol . "<br />\n"); //TRACE
				if($Certificat == 'Yes'){
				    echo "Possede un certificat.<br />\n"; //TRACE
				} else	{
				    echo "Ne possede pas un certificat.<br />\n"; //TRACE
				}
			} else if ($Type == 1){
				echo("Il s'agit d'une selette<br />\n"); //TRACE
				echo("Marque: " . $Marque . "<br />\n"); //TRACE
				echo("Modele: " . $Modele . "<br />\n"); //TRACE
				echo("Taille: " . $Taille . "<br />\n"); //TRACE
				echo("Protection selette: " . $ProtectionSelette . "<br />\n"); //TRACE
			} else if ($Type == 2){
				echo("Il s'agit d'un parachute de secours<br />\n"); //TRACE
				echo("Marque: " . $Marque . "<br />\n"); //TRACE
				echo("Modele: " . $Modele . "<br />\n"); //TRACE
				echo("Ptvmax: " . $Ptvmax . "<br />\n"); //TRACE
				echo("Ptvmin: " . $Ptvmin . "<br />\n"); //TRACE
			} else if ($Type == 3){
				echo("Il s'agit d'un accessoire<br />\n"); //TRACE
				echo("Marque: " . $Marque . "<br />\n"); //TRACE
				echo("Modele: " . $Modele . "<br />\n"); //TRACE
				echo("Type accessoire: " . $Typeaccessoire . "<br />\n"); //TRACE
			}
		}
		/*$nom =  "pierre";
		$prenom = "Beule";
		$tel = "0781638080";
		$email = "pierre.beule@gmail.com";
		$nbArticle = $_POST['index'];*/
		$nom = $_POST['inputNom'];
		$prenom = $_POST['inputPrenom'];
		$tel = $_POST['inputTelephone'];
		$email = $_POST['inputEmail'];
		$addresse ="3 rue des ponay";
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
