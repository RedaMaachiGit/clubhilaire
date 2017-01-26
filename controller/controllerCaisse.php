<?php
	//print_r($_POST);
	include_once('../model/caisse.php');

	if(isset($_POST['montantOuvertureCaisse'])){
		$montantOperation = $_POST['montantOuvertureCaisse'];
		$fondCaisse = $_POST['montantOuvertureCaisse'];
		$nomEmetteur = $_POST['nomEmetteur'];
		$prenomEmetteur = $_POST['prenomEmetteur'];
		$journee = $_POST['journee'];
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
		header('location:../index.html');

	} else if(isset($_POST['nomEmetteur']) && !isset($_POST['montantOuvertureCaisse'])){
		$montantOperation = Caisse::getLastFond();
		$nomEmetteur = "Caisse du Club Hilaire";
		$prenomEmetteur = "Caisse du Club Hilaire";
		$journee = $_POST['journee'];
		$telephoneEmetteur = "0000000000";
		$typeTransaction = "Fermeture caisse";
		$numero = "";
		$commentaire = "Fermeture de caisse en fin de journée";
		$typePaiement = "liquide";
		$beneficiare = $_POST['prenomEmetteur'] ." ". $_POST['nomEmetteur'];
		$caisse = new Caisse($journee,"0",$typePaiement,$montantOperation,$beneficiare,
													$nomEmetteur,$prenomEmetteur,$telephoneEmetteur,
													$typeTransaction,$date,$numero,$commentaire);
		$caisse->ouvrirFermerCaisse();
		header("Location:../views/caisseFermee.php?montant=".$montantOperation);

	} else {
		header('location:../index.html');
	}


	?>
