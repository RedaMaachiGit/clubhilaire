<?php
	session_start();
	include_once('../model/administration.php');


	class ControllerParametres {


		public static function getParams(){
			$params = Administration::getParams();
			$marge = Administration::getMarge();
			$_SESSION['params']= $params;
			$_SESSION['marge']= $marge;
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
			if(isset($_POST['marge']) && !empty($_POST['marge'])){
				$marge = $_POST['marge'];
				Administration::updateMarge($marge);
			}
			header('location:../views/parametres.php');
		}



	}
	if(isset($_POST['formEnvoie'])){
		if($_POST['formEnvoie'] == "marge"){
			ControllerParametres::setMarge();
		}
	}
	if(isset($_POST['formEnvoie'])){
		ControllerParametres::setParams();
	} else {
		ControllerParametres::getParams();
	}

?>
