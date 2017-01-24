<?php

//Cette classe représente les articles vendus par l'ecole saint Hilare
require_once('db.php');
require_once('lot.php');
require_once('marque.php');


class Article
{
  private $_idArticle;
  private $_type;
  private $_lot;
  private $_marque;
  private $_modele;
  private $_ptvMin;
  private $_ptvMax;
  private $_taille;
  private $_annee;
  private $_commentaire;
  private $_homologation;
  private $_surfaceVoile;
  private $_couleurVoile;
  private $_heureVolesVoile;
  private $_certificatRevisionVoile;
  private $_typeProtectonSelette;
  private $_typeAccessoire;



/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	 public function __construct($type, $lot, $marque,$modele, $ptvMin, $ptvMax, $taille, $surfaceVoile,
	 $couleurVoile, $heureVolesVoile, $certificatRevisionVoile, $typeProtectionSelette, $typeAccessoire, $annee, $commentaire, $homologation){
		$this->setTypeArticle($type);
		$this->setLot($lot);
		$this->setMarque($marque);
		$this->setModele($modele);
		$this->setPtvMin($ptvMin);
		$this->setPtvMax($ptvMax);
		$this->setTaille($taille);
		$this->setSurfaceVoile($surfaceVoile);
		$this->setCouleurVoile($couleurVoile);
		$this->setHeureVoile($heureVolesVoile);
		$this->setCertificat($certificatRevisionVoile);
		$this->setTypeProtectionSelette($typeProtectionSelette);
		$this->setTypeAccessoire($typeAccessoire);
		$this->setAnnee($annee);
		$this->setCommentaire($commentaire);
		$this->setHomologation($homologation);

	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// Getter ID
	 public function getId(){
		return $this->_idArticle;
	  }

	// Setter ID
	 public function setId($idArticle){
		$this->_idArticle = $idArticle;
	 }

	//setter TypeArticle
	public function setTypeArticle($typeArticle){
		$this->_type = $typeArticle;
	}


	 // Getter Lot
	 public function getLot(){
		return $this->_lot;
	  }

	// Setter Lot
	 public function setLot($lot){
		$this->_lot = $lot;
	 }

	// Getter Marque
	 public function getMarque(){
		return $this->_marque;
	  }

	// Setter Marque
	 public function setMarque($marque){
		$this->_marque = $marque;
	 }

	// Getter Modele
	 public function getModele(){
		return $this->_modele;
	  }

	// Setter Modele
	 public function setModele($modele){
		$this->_modele = $modele;
	 }

	//Getter typeArticle
	 public function getTypeArticle(){
		return $this->_type;
	  }


	//Getter ptvMin
	 public function getPtvMin(){
		return $this->_ptvMin;
	 }

	 //Setter ptvMin
	 public function setPtvMin($ptvMin){
		$this->_ptvMin = $ptvMin;
	  }

	 //Getter ptvMax
	 public function getPtvMax(){
		return $this->_ptvMax;
	 }

	 //Setter ptvMax
	 public function setPtvMax($ptvMax){
		$this->_ptvMax = $ptvMax;
	  }

	 //Getter taille
	 public function getTaille(){
		 return $this->_taille;
	 }

	 //Setter taille
	 public function setTaille($taille){
		$this->_taille = $taille;
	  }

	 //Getter surfaceVoile
	 public function getSurfaceVoile(){
		 return $this->_surfaceVoile;
	 }

	 //Setter surfaceVoile
	 public function setSurfaceVoile($surfaceVoile){
		$this->_surfaceVoile = $surfaceVoile;
	  }

	 //Getter couleurVoile
	 public function getCouleurVoile(){
		 return $this->_couleurVoile;
	 }

	 //Setter couleurVoile
	 public function setCouleurVoile($couleurVoile){
		$this->_couleurVoile = $couleurVoile;
	  }

	//Getter heureVolesVoile
	 public function getHeureVoile(){
		 return $this->_heureVoile;
	 }

	 //Setter heureVolesVoile
	 public function setHeureVoile($heureVoile){
		$this->_heureVoile = $heureVoile;
	  }

	//Getter certificat
	 public function getCertificat(){
		 return $this->_certificatRevisionVoile;
	 }

	 //Setter certificat
	 public function setCertificat($certificat){
		$this->_certificatRevisionVoile = $certificat;
	  }

	 //Getter typeProtectionSelette
	 public function getTypeProtectionSelette(){
		 return $this->_typeProtectonSelette;
	 }

	 //Setter typeProtectionSelette
	 public function setTypeProtectionSelette($typeProtectionSelette){
		$this->_typeProtectonSelette = $typeProtectionSelette;
	  }

	//Getter typeAccessoire
	 public function getTypeAccessoire(){
		 return $this->_typeAccessoire;
	 }

	 //Setter typeAccessoire
	 public function setTypeAccessoire($typeAccessoire){
		$this->_typeAccessoire = $typeAccessoire;
	  }

	 //Setter annee
	 public function setAnnee($annee){
		 $this->_annee = $annee;
	 }

	 //Getter Annne
	 public function getAnnee(){
		return $this->_annee;
	 }

	//Setter commentaire
	public function setCommentaire($commentaire){
		$this->_commnentaire = $commentaire;
	}

	//Getter commentaire
	public function getCommentaire(){
		return $this->_commentaire;
	}

	//Setter homologation
	public function setHomologation($homologation){
		$this->_homologation = $homologation;
	}

	//getter homologation
	public function getHomologation(){
		return $this->_homologation;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////FunctionToDataBase//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	/*
		public function save() -> Sauvegarder en base de données l'instance
		Input : Void
	    Output : Void
	*/

	public function save(){
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $type = $conn->real_escape_string($this->getTypeArticle());
	  $lot = $this->getLot();
	  $marque = $this->getMarque();
	  $modele = $this->getModele();
	  $ptvMin = $conn->real_escape_string($this->getPtvMin());
	  $ptvMax = $conn->real_escape_string($this->getPtvMax());
	  $taille = $conn->real_escape_string($this->getTaille());
	  $surfaceVoile = $conn->real_escape_string($this->getSurfaceVoile());
	  $couleurVoile = $conn->real_escape_string($this->getCouleurVoile());
	  $heureVoile = $conn->real_escape_string($this->getHeureVoile());
	  $certificat = $conn->real_escape_string($this->getCertificat());
	  $typeSelette = $conn->real_escape_string($this->getTypeProtectionSelette());
	  $typeAccessoire = $conn->real_escape_string($this->getTypeAccessoire());
	  $annee = $conn->real_escape_string($this->getAnnee());
	  $homologation = $conn->real_escape_string($this->getHomologation());
	  $commentaire = $conn->real_escape_string($this->getCommentaire());
	  $idL=null;
	  $idM=null;
	  $idMod=null;
	  if($lot!=null){
		  $idL=$lot->getId();
	}
	  if($modele!=null){
		$idMod=$modele->getId();
		if($marque!=null){
			$idM=$marque->getId();
			if($annee!=null){
				$query = "INSERT INTO article (idLot, idMarque, idModele, type, ptvMinimum, ptvMaximum, taille, annee, surfaceVoile, couleurVoile,heureVolesVoile, certificatRevisionVoile, typeProtectionSelette,
				typeAccessoire, commentaire, homologation) VALUES ('".$idL."','".$idM."','".$idMod."','".$type."','".$ptvMin."','".$ptvMax."','".$taille."','".$annee."','".$surfaceVoile."'
				,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."','".$commentaire."','".$homologation."')";
			}
			else{
				$query = "INSERT INTO article (idLot, idMarque, idModele, type, ptvMinimum, ptvMaximum, taille, surfaceVoile, couleurVoile,heureVolesVoile, certificatRevisionVoile, typeProtectionSelette,
				typeAccessoire, commentaire, homologation) VALUES ('".$idL."','".$idM."','".$idMod."','".$type."','".$ptvMin."','".$ptvMax."','".$taille."','".$surfaceVoile."'
				,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."','".$commentaire."','".$homologation."')";
			}
		}
		else{
			if($annee!=null){
				$query = "INSERT INTO article (idLot, idModele, type, ptvMinimum, ptvMaximum, taille, annee, surfaceVoile, couleurVoile,heureVolesVoile, certificatRevisionVoile, typeProtectionSelette,
				typeAccessoire, commentaire, homologation) VALUES ('".$idL."','".$idMod."','".$type."','".$ptvMin."','".$ptvMax."','".$taille."','".$annee."','".$surfaceVoile."'
				,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."','".$commentaire."','".$homologation."')";
			}
			else{
				$query = "INSERT INTO article (idLot, idModele, type, ptvMinimum, ptvMaximum, taille, surfaceVoile, couleurVoile,heureVolesVoile, certificatRevisionVoile, typeProtectionSelette,
				typeAccessoire, commentaire, homologation) VALUES ('".$idL."','".$idMod."','".$type."','".$ptvMin."','".$ptvMax."','".$taille."','".$surfaceVoile."'
				,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."','".$commentaire."','".$homologation."')";
			}
		}
	  }
	  else{
		if($marque!=null){
			$idM=$marque->getId();
			if($annee!=null){
				$query = "INSERT INTO article (idLot, idMarque, type, ptvMinimum, ptvMaximum, taille, annee, surfaceVoile, couleurVoile,heureVolesVoile, certificatRevisionVoile, typeProtectionSelette,
				typeAccessoire, commentaire, homologation) VALUES ('".$idL."','".$idM."','".$type."','".$ptvMin."','".$ptvMax."','".$taille."','".$annee."','".$surfaceVoile."'
				,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."','".$commentaire."','".$homologation."')";
			}
			else{
				$query = "INSERT INTO article (idLot, idMarque, type, ptvMinimum, ptvMaximum, taille, surfaceVoile, couleurVoile,heureVolesVoile, certificatRevisionVoile, typeProtectionSelette,
				typeAccessoire, commentaire, homologation) VALUES ('".$idL."','".$idM."','".$type."','".$ptvMin."','".$ptvMax."','".$taille."','".$surfaceVoile."'
				,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."','".$commentaire."','".$homologation."')";
			}
		}
		else{
			if($annee!=null){
				$query = "INSERT INTO article (idLot, type, ptvMinimum, ptvMaximum, taille, annee, surfaceVoile, couleurVoile,heureVolesVoile, certificatRevisionVoile, typeProtectionSelette,
				typeAccessoire, commentaire, homologation) VALUES ('".$idL."','".$type."','".$ptvMin."','".$ptvMax."','".$taille."','".$annee."','".$surfaceVoile."'
				,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."','".$commentaire."','".$homologation."')";
			}else{
				$query = "INSERT INTO article (idLot, type, ptvMinimum, ptvMaximum, taille, surfaceVoile, couleurVoile,heureVolesVoile, certificatRevisionVoile, typeProtectionSelette,
				typeAccessoire, commentaire, homologation) VALUES ('".$idL."','".$type."','".$ptvMin."','".$ptvMax."','".$taille."','".$surfaceVoile."'
				,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."','".$commentaire."','".$homologation."')";
			}
		}
	  }
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $idArticle = $conn->insert_id;
	  $this->setId($idArticle);
	  $db->close();
	 }

		/*
		public function delete() -> delete en base de données l'instance
		Input : Void
	    Output : Void
	*/

	public function delete() {
		$id = $this->getId();
		$query = "DELETE FROM article WHERE idArticle=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
	}

	public Static function deleteArticlesByIdLot($idLot){
	  $query = "DELETE FROM article WHERE idLot=".$idLot;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }

		/*
		public Static function getArticleById($id) -> get en base de données l'instance ayant l'id $id
		Input : $id
	    Output : l'article ayant l'id îd
	*/

	public Static function getArticleById($id){
	  $query = "SELECT * FROM article WHERE idArticle=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $lot = Lot::getLotById((int)$row[14]);
	  $marque = Marque::getMarqueById((int)$row[12]);
	  $modele = Modele::getModeleById((int)$row[13]);
	  $article = new Article((String)$row[1],$lot,$marque, $modele,(String)$row[2],(int)$row[3],(int)$row[4],(String)$row[6],(string)$row[7]
	  ,(String)$row[8],(int)$row[9],(string)$row[10],(string)$row[11],(string)$row[5],(string)$row[16],(string)$row[15]);
	  $article->setId((int)$row[0]);
	  return $article;
	 }

	public Static function gettAllArticle(){
	  $query = "SELECT * FROM article";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $res;
	 }

	public Static function gettAllArticleGroupByLot(){
	  $query = "SELECT * FROM article GROUP BY idLot";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $res;
	 }

	public Static function gettAllArticleGroupByMarque(){
	  $query = "SELECT * FROM article GROUP BY idMarque";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $res;
	 }

	public Static function getLotByCertificat(){
	  $query = "SELECT * FROM article WHERE certificat=true";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $lot = Lot::getLotById((int)$row[14]);
	  $marque = Marque::getMarqueById((int)$row[12]);
	  $modele = Modele::getModeleById((int)$row[13]);
	  $article = new Article((String)$row[1],$lot,$marque, $modele,(String)$row[2],(int)$row[3],(int)$row[4],(String)$row[6],(string)$row[7]
	  ,(String)$row[8],(int)$row[9],(string)$row[10],(string)$row[11],(string)$row[5],(string)$row[16],(string)$row[15]);
	  $article->setId((int)$row[0]);
	  return $article;
	 }

	public Static function getArticleByMarque($libelleMarque){
		$marque = Marque::getMarqueByLibelle($libelleMarque);
		$query = "SELECT * FROM article WHERE idMarque=".$marque->getId();
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		return res;
	 }


	 public static function getArticlesByLot($idLot){
		$query = "SELECT * FROM article WHERE idLot=".$idLot;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$articles = array();
		while ($row = $res->fetch_row()) {
      // print_r($row);
			$lot = Lot::getLotById((int)$row[14]);
			$marque = Marque::getMarqueById((int)$row[12]);
			$modele = Modele::getModeleById((int)$row[13]);
			$article = new Article((String)$row[1],$lot,$marque, $modele,(String)$row[2],(int)$row[3],(int)$row[4],(String)$row[6],(string)$row[7]
			,(String)$row[8],(int)$row[9],(string)$row[10],(string)$row[11],(string)$row[5],(string)$row[16],(string)$row[15]);
			$article->setId((int)$row[0]);
			array_push($articles,$article);
		}
		return $articles;
	 }

	public function getArticleByPtvMin($ptvMin){
		$query = "SELECT * FROM article WHERE ptvMin >=".$ptvMin;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		return res;
	 }

	public function getArticleByPtvMax($ptvMin){
		$query = "SELECT * FROM article WHERE ptvMax <=".$ptvMax;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		return res;
	 }

	public function getArticleByPtvMinAndMax($ptvMin,$ptvMax){
		$query = "SELECT * FROM article WHERE ptvMin >=".$ptvMin."AND ptvMax <=".$ptvMax;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		return res;
	 }

	public function updatePtvMin($ptvMin){
		$id = $this->getId();
		$query = "UPDATE article SET ptvMin =".$ptvMin." WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setPtvMin($ptvMin);
	 }

	public function updatePtvMax($ptvMax){
		$id = $this->getId();
		$query = "UPDATE article SET ptvMax =".$ptvMax." WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setPtvMax($ptvMax);
	 }

	 public function updateSurface($surface){
		$id = $this->getId();
		$query = "UPDATE article SET surfaceVoile =".$surface." WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setSurfaceVoile($surface);
	 }

	 public function updateTypeArticle($typeArticle){
		$id = $this->getId();
		$query = "UPDATE article SET typeArticle ='$typeArticle' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setTypeArticle($typeActicle);
	 }

	public function updateTypeAccessoire($typeAccessoire){
		$id = $this->getId();
		$query = "UPDATE article SET typeAccessoire ='$typeAccessoire' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setTypeAccessoire($typeAccessoire);
	 }

	public function updateCouleurVoile($couleurVoile){
		$id = $this->getId();
		$query = "UPDATE article SET couleurVoile ='$couleurVoile' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setCouleurVoile($couleurVoile);
	 }

	public function updateHeureVoile($heureVoile){
		$id = $this->getId();
		$query = "UPDATE article SET heureVoile ='$heureVoile' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setHeureVoile($heureVoile);
	 }

	public function updateCertificat($certificat){
		$id = $this->getId();
		$query = "UPDATE article SET certificat ='$certificat' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setCertificat($certificat);
	 }

	public function updateTypeProtectionSelette($typeProtectionSelette){
		$id = $this->getId();
		$query = "UPDATE article SET typeProtectionSelette ='$typeProtectionSelette' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		$this->setTypeProtectionSelette($typeProtectionSelette);
	 }
 	public function getLibelleTypeArticle(){
 		$type = $this->getTypeArticle();
 		if($type == 0){
      return "Voile";
    } else if($type == 1) {
      return "Selette";
    } else if($type == 2) {
      return "Parachute de secours";
    } else if($type == 3) {
      return "Accessoire";
    }
 	 }

   public static function changeColumnValue($columnName, $newValue, $primaryKey){
    $query = "UPDATE article SET ".$columnName." ='$newValue' WHERE idArticle=".$primaryKey;
    $db = new DB();
 		$db->connect();
 		$conn = $db->getConnectDb();
 		$res = $conn->query($query) or die(mysqli_error($conn));
 		$db->close();
   }
}
?>
