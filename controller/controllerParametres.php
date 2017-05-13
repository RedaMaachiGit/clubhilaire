<?php
	session_start();
	include_once('../model/administration.php');


	class ControllerParametres {


		public static function getParams(){
			$params = Administration::getParams();
			$marge = Administration::getMarge();
			$_SESSION['params']= $params;
			$_SESSION['marge']= $marge[0]['marge'];
			header('location:../views/parametres.php');
		}
		public static function setParams(){
			if(isset($_POST['nombreDeParams']) && !empty($_POST['nombreDeParams'])){
				$nombreDeParams = $_POST['nombreDeParams'];
				for($i=0;$i<$nombreDeParams;$i++){
					$idFraisDepot = $i;
					$fraisDepotAdmin = $_POST['fraisDepotAdmin' . $i];
					$niveauDepotAdmin = $_POST['niveauDepotAdmin' . $i];
					Administration::updateNiveauFraisDepotById($idFraisDepot,$niveauDepotAdmin);
					Administration::updateFraisDepotById($idFraisDepot,$fraisDepotAdmin);
				}
			}
			if(isset($_POST['newFraisDepotAdmin']) && isset($_POST['newNiveauDepotAdmin']) && !empty($_POST['newFraisDepotAdmin']) && !empty($_POST['newNiveauDepotAdmin'])){
				$fraisDepotAdmin = $_POST['newFraisDepotAdmin'];
				$niveauDepotAdmin = $_POST['newNiveauDepotAdmin'];
				Administration::addFraisDepot($niveauDepotAdmin, $fraisDepotAdmin);
			}
			$params = Administration::getParams();
			$_SESSION['params']= $params;
			header('location:../views/parametres.php');
		}

		public static function setMarge(){
			if(isset($_POST['newMarge']) && !empty($_POST['newMarge'])){
				$marge = $_POST['newMarge'];
				Administration::updateMarge($marge);
			}
			$_SESSION['marge']= $marge;
			ControllerParametres::setParams();
		}
		
		public static function setPrix(){
			if(isset($_POST['prix']) && !empty($_POST['prix'])){
				echo 'ici';
				$prix = $_POST['prix'];
				echo $prix;
				Administration::updatePrix($prix);
			}
			header('location:../views/parametres.php');
		}



	}

	if(isset($_POST['formEnvoie'])){
		ControllerParametres::setMarge();
	} else {
		ControllerParametres::getParams();
	}

?>
