<?php
	session_start();
	include_once('../model/caisse.php');


	class ComptabiliteController {
		public static function recupComptaJour($journee){
			$numberOfOperations = Caisse::getNumberOfOperations();
			$operations = Caisse::getCompta();
			$_SESSION['numberOfOperations']= $numberOfOperations;
			$_SESSION['operations']= serialize($operations);
			header('location:../views/consulterComptabilite.php');
		}


		public static function recupCompta(){
			$numberOfOperations = Caisse::getNumberOfOperations();
			$operations = Caisse::getCompta();
			$fondDeCaisse = Caisse::getLastFond();
			$_SESSION['numberOfOperations']= $numberOfOperations;
			$_SESSION['operations']= $operations;
			$_SESSION['fond']= $fondDeCaisse;
			$_SESSION['CB']= Caisse::getMontantPayeParTypePaiement("CB");
			$_SESSION['Liquide']= Caisse::getMontantPayeParTypePaiement("Liquide");
			$_SESSION['Cheque']= Caisse::getMontantPayeParTypePaiement("Cheque");
			header('location:../views/consulterComptabilite.php');
		}

	}

	ComptabiliteController::recupCompta();

?>
