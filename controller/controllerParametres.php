<?php
	session_start();
	include_once('../model/administration.php');


	class ControllerParametres {


		public static function getParams(){
			$params = Administration::getParams();
			$_SESSION['params']= $params;
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

	}
	if(isset($_POST['formEnvoie'])){
		ControllerParametres::setParams();
	} else {
		ControllerParametres::getParams();
	}

?>
