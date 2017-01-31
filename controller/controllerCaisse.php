<?php
	//print_r($_POST);
	include_once('../model/caisse.php');

	if(isset($_POST['montantOuvertureCaisse'])){
		$journee = $_POST['journee'];
		// echo Caisse::getOuvertureCaisse($journee);
		if(Caisse::getOuvertureCaisse($journee) == 0){
			header('location:../views/caisseDejaOuverte.html');
		} else {
			$montantOperation = $_POST['montantOuvertureCaisse'];
			$fondCaisse = $_POST['montantOuvertureCaisse'];
			$nomEmetteur = $_POST['nomEmetteur'];
			$prenomEmetteur = $_POST['prenomEmetteur'];
			$telephoneEmetteur = "0000000000";
			$typeTransaction = "Ouverture caisse";
			$numero = "";
			$date = date('d/m/Y');
			$commentaire = "Ouverture de caisse en début de journée";
			$typePaiement = "liquide";
			$beneficiare = "Caisse du Club Hilaire";
			$caisse = new Caisse($journee,$fondCaisse,$typePaiement,$montantOperation,$beneficiare,
														$nomEmetteur,$prenomEmetteur,$telephoneEmetteur,
														$typeTransaction,$date,$numero,$commentaire);
			$caisse->ouvrirFermerCaisse();
			header("Location:../views/caisseOuverte.php?montant=".$montantOperation);
		}
	} else if(isset($_POST['nomEmetteur']) && !isset($_POST['montantOuvertureCaisse'])){
		$montantOperation = Caisse::getLastFond();
		$journee = $_POST['journee'];
		// echo Caisse::getFermetureCaisse($journee);
		if(Caisse::getFermetureCaisse($journee) == 0){
			header('location:../views/caisseDejaFermee.html');
		} else {
			$nomEmetteur = "Caisse du Club Hilaire";
			$prenomEmetteur = "Caisse du Club Hilaire";
			$telephoneEmetteur = "0000000000";
			$typeTransaction = "Fermeture caisse";
			$numero = "";
			$commentaire = "Fermeture de caisse en fin de journée";
			$typePaiement = "liquide";
			$date = date('d/m/Y');
			$beneficiare = $_POST['prenomEmetteur'] ." ". $_POST['nomEmetteur'];
			$caisse = new Caisse($journee,"0",$typePaiement,$montantOperation,$beneficiare,
														$nomEmetteur,$prenomEmetteur,$telephoneEmetteur,
														$typeTransaction,$date,$numero,$commentaire);
			$caisse->ouvrirFermerCaisse();
			header("Location:../views/caisseFermee.php?montant=".$montantOperation);
		}
	} else {
		
	}


	?>
