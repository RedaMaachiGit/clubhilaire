<?php
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');

class ControllerImportEcole {
	
	
	public static function lireExcel(){
		/** Include path **/
		set_include_path(get_include_path() . PATH_SEPARATOR . '../excel/Classes/');

		/** PHPExcel_IOFactory */
		include '../excel/Classes/PHPExcel/IOFactory.php';
		$nomFichier = $_POST['exampleInputFileEcole'];		
		$inputFileName = '../excel/pre_inscription_ecole/'.$nomFichier;
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

		$nomEcole= $objPHPExcel->getActiveSheet()->getCell('B2');
		$telephone = $objPHPExcel->getActiveSheet()->getCell('B3');
		$email = $objPHPExcel->getActiveSheet()->getCell('B4');
		$contactEcole = $objPHPExcel->getActiveSheet()->getCell('B5');

		$vendeur = Vendeur::getVendeurByMail($email);
		if($vendeur!=null){
			$vendeur->updateMail($email);
			$vendeur->updateVendeur($nomEcole,$contactEcole,"",$telephone,"professionnel",-1);
			$lots = Lot::getLotByVendeur($vendeur->getId());
			Lot::deleteLotByIdVendeur($vendeur->getId());
			for($p=0; $p<=count($lots)-1; $p++){
				Article::deleteArticlesByIdLot($lots[$p]->getId());
			}
		}else{
			$vendeur = new Vendeur($nomEcole,$contactEcole,$telephone,$email,"","professionnel","",-1);
			$vendeur->save();
		}

		$ligne = 14;
		$colonne = "B";
		while ($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne)!="") {
			$prix = $objPHPExcel->getActiveSheet()->getCell("B".$ligne);
			$numeroLotVendeur = $objPHPExcel->getActiveSheet()->getCell("A".$ligne);
			$numeroLotVendeur = $pieces = explode(" ", $numeroLotVendeur);
			$lot = new Lot(1,$numeroLotVendeur[1],$prix,$vendeur);
			$lot->savePreInscription();
			$lot->updateStatut("En preInscription");
			$numeroLotVendeur++;
			$colonne++;
			$colonne++;
			while($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne)!=""){
				$typeMatos = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				if(strcmp($typeMatos,"voile")==0){
					$typeMatos=0;
				}else if(strcmp($typeMatos,"selette")==0){
					$typeMatos=1;
				}else if(strcmp($typeMatos,"accessoire")==0){
					$typeMatos=3;
				}else if(strcmp($typeMatos,"secours")==0){
					$typeMatos=2;
				}
				$colonne++;
				$marque = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$modele = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$categorie = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$annee = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$couleur = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$taille = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$ptvmin = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$ptvmax = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$homologation = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$certificat = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$nbHeureVole = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$colonne++;
				$surface=0;
				
				$marqueArticle = ControllerImportEcole::ajoutMarque($marque);
				$modeleArticle = ControllerImportEcole::ajoutModele($marqueArticle,$modele,$categorie);
				$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$surface,$couleur,$nbHeureVole,
				$certificat,"","",$annee,"",$homologation);
				$article->save();
			}
			$colonne = "B";
			$ligne++;
		}
	}
	
	public static function ajoutMarque($Libellemarque){
		if(!Marque::marqueExistByLibelle($Libellemarque)){ //si la marque rentré n'existe pas
			$newMarque = new Marque($Libellemarque); //on crée la marque
			$newMarque->save();
		}else{
			$newMarque = Marque::getMarqueByLibelle($Libellemarque); //la marque existe alors on la récupère
		}
		return $newMarque;
		}
	
	public static function ajoutModele($marque,$Libellemodele, $categorie){
			if(!Modele::modeleExistByLibelle($Libellemodele)){ //si le modèle n'existe pas
					$newModele = new Modele($Libellemodele,$marque,$categorie); //on crée le modèle
					$newModele->save();
				}else{
					$newModele = Modele::getModeleByLibelle($Libellemodele); //sinon on récupère le modele
				}
			return $newModele;
		}
	}
	
	ControllerImportEcole::LireExcel();
	header('location:../views/ajoutFichierEffectue.php');
?>