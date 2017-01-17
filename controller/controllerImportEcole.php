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
		$numeroLotVendeur = 1;
		while ($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne)!="") {
			$prix = $objPHPExcel->getActiveSheet()->getCell($colonne.$ligne);
			$lot = new Lot(1,$numeroLotVendeur,$prix,$vendeur);
			$lot->savePreInscription();
			$lot->updateStatut("En preInscription");
			$numeroLotVendeur++;
			$colonne++;
			$colonne++;
			while($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne)!=""){
				$typeMatos = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $typeMatos;
				$colonne++;
				$marque = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $marque;
				$colonne++;
				$modele = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $modele;
				$colonne++;
				$categorie = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $categorie;
				$colonne++;
				$annee = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $annee;
				$colonne++;
				$couleur = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $couleur;
				$colonne++;
				$taille = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $taille;
				$colonne++;
				$ptvmin = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $ptvmin;
				$colonne++;
				$ptvmax = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $ptvmax;
				$colonne++;
				$homologation = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $homologation;
				$colonne++;
				$certificat = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $certificat;
				$colonne++;
				$nbHeureVole = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				echo $nbHeureVole;
				$colonne++;
				$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
				$colonne++;
				$colonne++;
				echo $commentaire;
				echo "   nouvelle article";
				echo "<br>";
				echo " colonne :"; echo $colonne;
				echo "<br>";
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
?>