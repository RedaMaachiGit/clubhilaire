<?php
include_once('../model/vendeur.php');
include_once('../model/lot.php');
include_once('../model/article.php');
include_once('../model/modele.php');

class ControllerImportParticulier {
	
	
	public static function lireExcel(){
		/** Include path **/
		set_include_path(get_include_path() . PATH_SEPARATOR . '../excel/Classes/');

		/** PHPExcel_IOFactory */
		include '../excel/Classes/PHPExcel/IOFactory.php';
		$nomFichier = $_POST['exampleInputFileParticulier'];
		$inputFileName = '../excel/pre_inscription_particulier/'.$nomFichier;
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

		$ligne = 2;
		while ($objPHPExcel->getActiveSheet()->getCell("E".$ligne)!="") {
			$nom=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("B".$ligne));
			$prenom =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("C".$ligne));
			$telephone =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("D".$ligne));
			$mail =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("E".$ligne));
			$cheque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BI".$ligne));
			if($cheque="OUI"){
				$cheque=1;
			}else{
				$cheque=0;
			}
			if(!Vendeur::vendeurExistByMail($mail)){
				$vendeur = new Vendeur($nom,$prenom,$telephone,$mail,"","particulier","",$cheque);	
				$vendeur->save();
			}else{
				$vendeur = Vendeur::getVendeurByMail($mail);
			}
			
			if(!Lot::lotExistByNumPre((String)$objPHPExcel->getActiveSheet()->getCell("H".$ligne))) {
			
				$numPre = $objPHPExcel->getActiveSheet()->getCell("H".$ligne);
				$prix =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BE".$ligne));
				if((int)$prix%10!=0 or (int)$prix < (int)Administration::getPrix()){
					header('location:../views/ajoutFichierNonEffectue.php');
				}
				$lot = new Lot(1,"pas de numero",$prix,$vendeur);
				$lot->savePreInscription();
				$lot->updateStatut("En preInscription");
				$lot->updateNumPreInscription($numPre);
				//ajout 1er article 
				$categorie = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("P".$ligne));
				$marque = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("R".$ligne));
				if($marque!=""){
					$typeMatos=0;
					$modele = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("S".$ligne));
					$taille = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("T".$ligne));
					$ptvmin = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("V".$ligne));
					$ptvmax = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("W".$ligne));
					$nbHeureVole = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("X".$ligne));
					$annee = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("Y".$ligne));
					$certificat = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("Z".$ligne));
					$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AA".$ligne));			
					$couleur = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BQ".$ligne));			
					$homologation = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BG".$ligne));			
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,$commentaire,$homologation);
					$article->save();
				}
					
				//ajout de sellette si présent
				if($objPHPExcel->getActiveSheet()->getCell("AB".$ligne)!=""){
					$typeMatos=1;
					$categorie=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AB".$ligne));
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AC".$ligne));
					$taille =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AD".$ligne));
					$annee =  (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AE".$ligne));
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AF".$ligne));
					$commentaire =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AG".$ligne));
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,$commentaire,$homologation);
					$article->save();
				}
				//ajout du secour si présent
				if($objPHPExcel->getActiveSheet()->getCell("AI".$ligne)!=""){
					$typeMatos=2;
					$categorie=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AI".$ligne));
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AJ".$ligne));
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AK".$ligne));
					$surface =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AL".$ligne));
					$annee = (int) htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AN".$ligne));
					$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AQ".$ligne));
					$ptvmax = (int) htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BL".$ligne));
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,$commentaire,$homologation);
					$article->save();
				}
				//ajout du Vario ou GPS
				if($objPHPExcel->getActiveSheet()->getCell("AQ".$ligne)!=""){
					$typeMatos=3;
					$categorie=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AQ".$ligne));
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AR".$ligne));
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AS".$ligne));
					$annee =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AT".$ligne));
					$marqueArticle = ControllerImportEcole::ajoutMarque($marque);
					$modeleArticle = ControllerImportEcole::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,$commentaire,$homologation);
					$article->save();
				}
				//ajout radio
				if($objPHPExcel->getActiveSheet()->getCell("AV".$ligne)!=""){
					$typeMatos=3;
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AV".$ligne));
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AW".$ligne));
					$annee = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AX".$ligne));
					$commentaire =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AY".$ligne));
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,$commentaire,$homologation);
					$article->save();
				}
				//ajout accessoire
				if($objPHPExcel->getActiveSheet()->getCell("BM".$ligne)!=""){
					$typeMatos=3;
					$categorie=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BM".$ligne));
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BN".$ligne));
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BO".$ligne));
					$annee = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BQ".$ligne));
					$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BA".$ligne));
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,$commentaire,$homologation);
					$article->save();
				}			
			}
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
	
	ControllerImportParticulier::LireExcel();
	header('location:../views/ajoutFichierEffectue.php');
?>