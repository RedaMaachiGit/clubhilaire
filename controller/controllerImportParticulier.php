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
			echo "NOM : ";
			echo $nom;
			echo "   ";
			$prenom =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("C".$ligne));
			echo $prenom;
			echo "   ";
			$telephone =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("D".$ligne));
			echo $telephone;
			echo "   ";
			$mail =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("E".$ligne));
			echo $mail;
			echo "   ";
			$cheque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BI".$ligne));
			echo $cheque;
			echo "   ";
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
				$lot = new Lot(1,"pas de numero",$prix,$vendeur);
				$lot->savePreInscription();
				$lot->updateStatut("En preInscription");
				$lot->updateNumPreInscription($numPre);
				echo "<br>";
				echo "Ajout 1er article : ";
				//ajout 1er article 
				$categorie = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("P".$ligne));
				echo "CATEGORIE : ";
				echo $categorie;
				echo "   ";
				$marque = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("R".$ligne));
				if($marque!=""){
					$typeMatos="voile";
					echo "MARQUE : ";
					echo $marque;
					echo "   ";
					$modele = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("S".$ligne));
					echo "MODELE : ";
					echo $modele;
					echo "   ";
					$taille = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("T".$ligne));
					echo "TAILE : ";
					echo $taille;
					echo "   ";
					$ptvmin = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("V".$ligne));
					echo "ptvmin : ";
					echo $ptvmin;
					echo "   ";
					$ptvmax = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("W".$ligne));
					echo "ptvmax : ";
					echo $ptvmax;
					echo "   ";
					$nbHeureVole = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("X".$ligne));
					echo "heureVoile : ";
					echo $nbHeureVole;
					echo "   ";
					$annee = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("Y".$ligne));
					echo "annnee : ";
					echo $annee;
					echo "   ";
					$certificat = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("Z".$ligne));
					echo "certificat : ";
					echo $certificat;
					echo "   ";
					$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AA".$ligne));			
					echo "commentaire : ";
					echo $commentaire;
					echo "   ";
					$couleur = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BQ".$ligne));			
					echo "couleur : ";
					echo $couleur;
					echo "   ";
					$homologation = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BG".$ligne));			
					echo "couleur : ";
					echo $couleur;
					echo "   ";
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,"",$homologation);
					$article->save();
				}
					
				echo "<br>";
				echo "<br>";
				echo "ajout selette";
				//ajout de selette si présent
				if($objPHPExcel->getActiveSheet()->getCell("AB".$ligne)!=""){
					$typeMatos="selette";
					echo $typeMatos;
					$categorie=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AB".$ligne));
					echo "CATEGORIE : ";
					echo $categorie;
					echo "   ";
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AC".$ligne));
					echo "MARQUE : ";
					echo $marque;
					echo "    ";
					$taille =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AD".$ligne));
					echo "TAILLE : ";
					echo $taille;
					echo "    ";
					$annee =  (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AE".$ligne));
					echo "ANNEE : ";
					echo $annee;
					echo "     ";
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AF".$ligne));
					echo "MODELE : ";
					echo $modele;
					echo "    ";
					$commentaire =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AG".$ligne));
					echo "COMMENTAIRE : ";
					echo $commentaire;
					echo "   ";
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,"",$homologation);
					$article->save();
				}
				//ajout du secour si présent
				if($objPHPExcel->getActiveSheet()->getCell("AI".$ligne)!=""){
					$typeMatos="secoure";
					echo $typeMatos;
					$categorie=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AI".$ligne));
					echo $categorie;
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AJ".$ligne));
					echo $marque;
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AK".$ligne));
					echo $modele;
					$surface =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AL".$ligne));
					echo $surface;
					$annee = (int) htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AN".$ligne));
					echo $annee;
					$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AQ".$ligne));
					echo $commentaire;
					$ptvmax = (int) htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BL".$ligne));
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,"",$homologation);
					$article->save();
				}
				//ajout du Vario ou GPS
				if($objPHPExcel->getActiveSheet()->getCell("AQ".$ligne)!=""){
					$typeMatos="Vario/GPS";
					echo $typeMatos;
					$categorie=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AQ".$ligne));
					echo $categorie;
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AR".$ligne));
					echo $marque;
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AS".$ligne));
					echo $modele;
					$annee =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AT".$ligne));
					echo $annee;
					$marqueArticle = ControllerImportEcole::ajoutMarque($marque);
					$modeleArticle = ControllerImportEcole::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,"",$homologation);
					$article->save();
				}
				//ajout radio
				if($objPHPExcel->getActiveSheet()->getCell("AV".$ligne)!=""){
					$typeMatos="Radio";
					echo $typeMatos;
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AV".$ligne));
					echo $marque;
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AW".$ligne));
					echo $modele;
					$annee = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AX".$ligne));
					echo $annee;
					$commentaire =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("AY".$ligne));
					echo $commentaire;
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,"",$homologation);
					$article->save();
				}
				//ajout accessoire
				if($objPHPExcel->getActiveSheet()->getCell("BM".$ligne)!=""){
					$typeMatos="accessoire";
					echo $typeMatos;
					$categorie=  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BM".$ligne));
					echo $categorie;
					$marque =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BN".$ligne));
					echo $marque;
					$modele =  htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BO".$ligne));
					echo $modele;
					$annee = (int)htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BQ".$ligne));
					echo $annee;
					$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell("BA".$ligne));
					echo $commentaire;
					$marqueArticle = ControllerImportParticulier::ajoutMarque($marque);
					$modeleArticle = ControllerImportParticulier::ajoutModele($marqueArticle,$modele,$categorie);
					$article = new Article($typeMatos,$lot,$marqueArticle,$modeleArticle,$ptvmin,$ptvmax,$taille,$taille,$couleur,$nbHeureVole,
					$certificat,"","",$annee,"",$homologation);
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
?>