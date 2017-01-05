<?php
	// Déclaeation du Modele Lot
	// Déclaeation du Modele Produit
	//$modeleCreationLot = new Lot(12, $statut, $prix);
	//$modeleCreationProduit = new
	echo("First name: " . $_POST['inputNom'] . "<br />\n");
	echo("Last name: " . $_POST['inputPrenom'] . "<br />\n");
	echo("Phone: " . $_POST['inputTelephone'] . "<br />\n");
	echo("Email: " . $_POST['inputEmail'] . "<br />\n");
	echo("Index of products: " . $_POST['index'] . "<br />\n");
	if(isset($_POST['index']) && !empty($_POST['index'])) {
		$numberOfProducts = $_POST['index'];
	} else {
		$numberOfProducts = 1;
	}
	for ($i = 0; $i <= $numberOfProducts-1; $i++) {
		$Type = $_POST['article'][$i][typedematos];
		$Marque = $_POST['article'][$i][inputmarque];
		$Modele = $_POST['article'][$i][inputmodele];
		$Ptvmax = $_POST['article'][$i][inputptvmax];
		$Ptvmin = $_POST['article'][$i][inputptvmin];
		$Taille = $_POST['article'][$i][inputtaille];
		$Surface = $_POST['article'][$i][inputsurface];
		$Couleur = $_POST['article'][$i][inputcouleur];
		$Heuresdevol = $_POST['article'][$i][inputheuresdevol];
		$Certificat = $_POST['article'][$i][inputcertificat];
		$Typeaccessoire = $_POST['article'][$i][inputtypeaccessoire];

		if($Type == 0){
 			echo("Il s'agit d'une voile<br />\n");
			echo("Marque: " . $Marque . "<br />\n");
			echo("Modele: " . $Modele . "<br />\n");
			echo("Ptvmax: " . $Ptvmax . "<br />\n");
			echo("Ptvmin: " . $Ptvmin . "<br />\n");
			echo("Taille: " . $Taille . "<br />\n");
			echo("Surface: " . $Surface . "<br />\n");
			echo("Couleur: " . $Couleur . "<br />\n");
			echo("Heures de vol: " . $Heuresdevol . "<br />\n");
			echo("Certificat: " . $Certificat . "<br />\n");
		} else if ($Type == 1){
 			echo("Il s'agit d'une selette<br />\n");
			echo("Marque: " . $Marque . "<br />\n");
			echo("Modele: " . $Modele . "<br />\n");
			echo("Taille: " . $Taille . "<br />\n");
		} else if ($Type == 2){
 			echo("Il s'agit d'un parachute de secours<br />\n");
			echo("Marque: " . $Marque . "<br />\n");
			echo("Modele: " . $Modele . "<br />\n");
			echo("Ptvmax: " . $Ptvmax . "<br />\n");
			echo("Ptvmin: " . $Ptvmin . "<br />\n");
		} else if ($Type == 3){
 			echo("Il s'agit d'un accessoire<br />\n");
			echo("Marque: " . $Marque . "<br />\n");
			echo("Modele: " . $Modele . "<br />\n");
			echo("Type accessoire: " . $Typeaccessoire . "<br />\n");
		}
	}

		// function createLot(){
		// 	$Marque = $_POST['article[' .$i. '][inputmarque]'];
		// 	$Modele = $_POST['article[' .$i. '][inputmodele]'];
		// 	$Ptvmax = $_POST['article[' .$i. '][inputptvmax]'];
		// 	$Ptvmin = $_POST['article[' .$i. '][inputptvmin]'];
		// 	$Taille = $_POST['article[' .$i. '][inputtaille]'];
		// 	$Surface = $_POST['article[' .$i. '][inputsurface]'];
		// 	$Couleur = $_POST['article[' .$i. '][inputcouleur]'];
		// 	$Heuresdevol = $_POST['article[' .$i. '][inputheuresdevol]'];
		// 	$Typeaccessoire = $_POST['article[' .$i. '][inputtypeaccessoire]'];
		// 	$Certificat = $_POST['article[' .$i. '][inputcertificat]'];
		// 	// Cree le lot
		// }
		// function deleteLot(){
		// 	$Marque = $_POST['article[' .$i. '][inputmarque]'];
		// 	$Modele = $_POST['article[' .$i. '][inputmodele]'];
		// 	$Ptvmax = $_POST['article[' .$i. '][inputptvmax]'];
		// 	$Ptvmin = $_POST['article[' .$i. '][inputptvmin]'];
		// 	$Taille = $_POST['article[' .$i. '][inputtaille]'];
		// 	$Surface = $_POST['article[' .$i. '][inputsurface]'];
		// 	$Couleur = $_POST['article[' .$i. '][inputcouleur]'];
		// 	$Heuresdevol = $_POST['article[' .$i. '][inputheuresdevol]'];
		// 	$Typeaccessoire = $_POST['article[' .$i. '][inputtypeaccessoire]'];
		// 	$Certificat = $_POST['article[' .$i. '][inputcertificat]'];
		// 	// Cree le lot
		// }
?>
