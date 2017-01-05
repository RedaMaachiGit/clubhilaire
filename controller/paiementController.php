<?php
	//print_r($_POST);
	echo("Index of products: " . $_POST['index'] . "<br />\n");
	if(isset($_POST['index']) && !empty($_POST['index'])) {
		$numberOfProducts = $_POST['index'];
	} else {
		$numberOfProducts = 1;
	}
	for ($i = 0; $i <= $numberOfProducts-1; $i++) {
		$Type = $_POST['paiement'][$i][typedepaiement];
		$Nom = $_POST['paiement'][$i][inputNom];
		$Prenom = $_POST['paiement'][$i][inputPrenom];
		$Telephone = $_POST['paiement'][$i][inputTelephone];
		$Numero = $_POST['paiement'][$i][inputNumero];
		$Commentaire = $_POST['paiement'][$i][inputCommentaire];
		$Montant = $_POST['paiement'][$i][inputMontant];
		if($Type == 0){
 			echo("Il s'agit d'une CB<br />\n");
			echo("Nom: " . $Nom . "<br />\n");
			echo("Prenom: " . $Prenom . "<br />\n");
			echo("Telephone: " . $Telephone . "<br />\n");
			echo("Numero: " . $Numero . "<br />\n");
			echo("Commentaire: " . $Commentaire . "<br />\n");
			echo("Montant: " . $Montant . "<br />\n");
		} else if ($Type == 1){
			echo("Il s'agit d'un chèque<br />\n");
			echo("Nom: " . $Nom . "<br />\n");
			echo("Prenom: " . $Prenom . "<br />\n");
			echo("Telephone: " . $Telephone . "<br />\n");
			echo("Numero: " . $Numero . "<br />\n");
			echo("Commentaire: " . $Commentaire . "<br />\n");
			echo("Montant: " . $Montant . "<br />\n");
		} else if ($Type == 2){
			echo("Il s'agit d'un paiement en liquide<br />\n");
			echo("Nom: " . $Nom . "<br />\n");
			echo("Prenom: " . $Prenom . "<br />\n");
			echo("Telephone: " . $Telephone . "<br />\n");
			echo("Numero: " . $Numero . "<br />\n");
			echo("Commentaire: " . $Commentaire . "<br />\n");
			echo("Montant: " . $Montant . "<br />\n");
		}
	}
?>
