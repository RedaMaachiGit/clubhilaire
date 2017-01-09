<?php

include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');
include_once('../model/marque.php');


class ControllerModificationLot {
	
	public static function modifierVendeur(){
		$nom = $_POST['inputNom'];
		$prenom = $_POST['inputPrenom'];
		$tel = $_POST['inputTelephone'];
		$email = $_POST['inputEmail'];
		$idVendeur = $_POST['inputIdVendeur'];
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
	
	public static function modificationLot(){
		$prixVente = "";
		$vendeur = ControllerModificationLot::modifierVendeur();
		/*$lot = new Lot($numeroCoupon,$numeroLotVendeur,$prixVente,$vendeur); //On créer le lot et on l'associe au vendeur
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
		}*/
	}
	

}

controllerModificationLot::modificationLot();


?>
