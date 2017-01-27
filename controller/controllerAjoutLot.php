<?php
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');

// print_r($_POST);
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
			$typeProtectionSelette="";
			$annee=null;
			$typeAccessoire="";
			$homologation = "";
			$type = $_POST['article'][$i]['typedematos'];
			if(isset($_POST['article'][$i]['inputannee']) && !empty($_POST['article'][$i]['inputannee'])){
				$annne = $_POST['article'][$i]['inputannee'];
			}
			if($type == 0){
				$ptvMax = $_POST['article'][$i]['inputptvmax'];
				$ptvMin = $_POST['article'][$i]['inputptvmin'];
				$annee = $_POST['article'][$i]['inputannee'];
				if($_POST['article'][$i]['typehomologation'] == 0){
					$homologation = "EN A / DHV LTF-1";
				}else if($_POST['article'][$i]['typehomologation'] == 1){
					$homologation = "EN B / DHV LTF 1-2";
				}else if($_POST['article'][$i]['typehomologation'] == 2){
					$homologation = "EN C / DHV LTF 2";
				}else if($_POST['article'][$i]['typehomologation'] == 3){
					$homologation = "EN D / DHV LTF 2-3";
				}else if($_POST['article'][$i]['typehomologation'] == 4){
					$homologation = "NON HOMOLOGUE";
				}else if($_POST['article'][$i]['typehomologation'] == 5){
					$homologation = "INCONNUE";
				}
				$taille = $_POST['article'][$i]['inputtaille'];
				$surface = $_POST['article'][$i]['inputsurface'];
				$couleur = $_POST['article'][$i]['inputcouleur'];
				$heuresDeVol = $_POST['article'][$i]['inputheuresdevol'];
				if (isset($_POST['article'][$i]['inputcertificat'])) {
					$certificat = $_POST['article'][$i]['inputcertificat'];
				}
			} else if ($type == 1){
				$taille = $_POST['article'][$i]['inputtaille'];
				$typeProtectionSelette = $_POST['article'][$i]['inputprotectionSelette'];
				$annee = $_POST['article'][$i]['inputannee'];
			} else if ($type == 2){
				$ptvmax = $_POST['article'][$i]['inputptvmax'];
				$ptvmin = $_POST['article'][$i]['inputptvmin'];
				$annee = $_POST['article'][$i]['inputannee'];
			} else if ($type == 3){
				$typeAccessoire = $_POST['article'][$i]['inputtypeaccessoire'];
				$annee = $_POST['article'][$i]['inputannee'];
			}
		$article = new Article($type,$lot,$marque,$modele,$ptvMin,$ptvMax,$taille,$surface,$couleur,$heuresDeVol,
		$certificat,$typeProtectionSelette,$typeAccessoire,$annee,"",$homologation);
		$article->save();
	}
	public static function ajoutVendeur(){
		$nom = $_POST['inputNom'];
		$prenom = $_POST['inputPrenom'];
		$tel = $_POST['inputTelephone'];
		$email = $_POST['inputEmail'];
		$addresse = $_POST['inputAdresse'];
		$type = "particulier";
		$numPreInscription = "";
		$cheque = null;
		if (isset($_POST['inputCheque'])) {
			$cheque = $_POST['inputCheque'];
		}
		if (isset($_POST['inputPro'])) {
			$type = "professionnel";
		}
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
		$GLOBALS['numeroCoupon'] = -1;
		$GLOBALS['numeroLot'] = $lot->getId();
		if(isset($_POST['index']) && !empty($_POST['index'])) {
			$numberOfProducts = $_POST['index'];
		} else {
			$numberOfProducts = 1;
		}
		for ($i = 0; $i <= $numberOfProducts; $i++){		//Pour chaque article
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
	window.top.location='../views/NumeroCoupon.php?mail=<?php echo $_POST['inputEmail']; ?>';
</script>
