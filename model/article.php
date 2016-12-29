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
  private $_ptvMin;
  private $_ptvMax;
  private $_taille;
  private $_annee;
  
  private $_surfaceVoile;
  private $_couleurVoile;
  private $_heureVolesVoile;
  private $_certificatRevisionVoile;
  private $_typeProtectonSelette;
  private $_typeAccessoire;
  
   
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 
	 public function __construct($type, $lot, $marque, $ptvMin, $ptvMax, $taille, $surfaceVoile,
	 $couleurVoile, $heureVolesVoile, $certificatRevisionVoile, $typeProtectionSelette, $typeAccessoire, $annee){	 
		$this->setTypeArticle($type);
		$this->setLot($lot);
		$this->setMarque($marque);
		$this->setPtvMin($ptvMin); 
		$this->setPtvMax($ptvMax);
		$this->setTaille($taille);
		$this->setSurfaceVoile($surfaceVoile);
		$this->setCouleurVoile($couleurVoile);
		$this->setHeureVoile($heureVolesVoile);
		$this->setCertification($certificationRevisionVoile);
		$this->setTypeProtectionSelette($typeProtectionSelette);
		$this->setTypeAccesoire($typeAccessoire);
		$this->setAnnee($annee);
		
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
	 
	 // Getter Lot 
	 public function getLot(){
		return $this->_lot;
	  }
	  
	// Setter Lot 
	 public function setLot($lot){
		$this->_lot = $lot;
	 }
	 
	// Getter Article 
	 public function getMarque(){
		return $this->_marque;
	  }
	  
	// Setter Article 
	 public function setMarque($marque){
		$this->_marque = $marque;
	 }
	 
	//Getter typeArticle 
	 public function getTypeArticle(){
		return $this->_type;
	  }
	 
	//Setter typeArticle 
	 public function setCoupon($type){
		if (!is_String($type)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le type d\'un article doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_type = $type;
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
		if (!is_String($certificat)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le typeCertificat d\'un article doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_certificatRevisionVoile = $certificat;
	  }
	  
	 //Getter typeProtectionSelette
	 public function getTypeProtectionSelette(){
		 return $this->_typeProtectonSelette;
	 }
	 
	 //Setter typeProtectionSelette
	 public function setTypeProtectionSelette($typeProtectionSelette){
		if (!is_String($typeProtectionSelette)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le typeProtectionSelette d\'un article doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_typeProtectonSelette = $typeProtectionSelette;
	  }
	  
	//Getter typeAccessoire
	 public function getTypeAccessoire(){
		 return $this->_typeAccessoire;
	 }
	 
	 //Setter typeAccessoire
	 public function setTypeAccessoire($typeAccessoire){
		 if (!is_String($typeAccessoire)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le typeAccessoire d\'un article doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
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
	  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////FunctionToDataBase//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	/* 
		public function save() -> Sauvegarder en base de données l'instance
		Input : Void 
	    Output : Void
	*/
	
	public function save(){
	  $type = $this->getTypeArticle();
	  $lot = $this->getLot();
	  $marque = $this->getMarque();
	  $ptvMin = $this->getPtvMin();
	  $ptvMax = $this->getPtvMax();
	  $taile = $this->getTaille();
	  $surfaceVoile = $this->getSurfaceVoile();
	  $couleurVoile = $this->getCouleurVoile();
	  $heureVoile = $this->getHeureVoile();
	  $certificat = $this->getCertificat();
	  $typeSelette = $this->getTypeProtectionSelette();
	  $typeAccessoire = $this->getTypeAccessoire();
	  $idL=null;
	  $idM=null;
	  if($marque!=null){
		  $idM=$marque->getId();
	  }
	  if($lot!=null){
		  $idL=$lot->getId();
	  }
	  
	  $query = "INSERT INTO Article (idArticle, idLot, idMarque, type, ptvMin, ptvMax, taile, surfaceVoile, couleurVoile, certificat, typeSelette,
	  typeAccesoire) VALUES ('','".$idL."','".$idM."','".$type."','".$ptvMin."','".$ptvMax."','".$taile."','".$surfaceVoile."'
	  ,'".$couleurVoile."','".$heureVoile."','".$certificat."','".$typeSelette."','".$typeAccessoire."')";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
		/* 
		public function delete() -> delete en base de données l'instance
		Input : Void
	    Output : Void
	*/ 
	
	public function delete() {
		$id = $this->getId();
		$query = "DELETE FROM Lot WHERE idLot=".$id;
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
	  $query = "SELECT * FROM Article WHERE idArticle=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $lot = Lot::getLotById((int)$row[1]);
	  $marque = Marque::getMarqueById((int)$row[2]);
	  $article = new Article($lot,$marque,(String)$row[3],(int)$row[4],(int)$row[5],(String)$row[6],(int)$row[7]
	  ,(String)$row[8],(int)$row[9],(string)$row[10],(string)$row[11],(string)$row[12]);
	  $article->setId((int)$row[0]);
	  return $article;
	 }
	 
	public Static function gettAllArticle(){ 
	  $query = "SELECT * FROM Article";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $res;
	 }
	 
	public Static function gettAllArticleGroupByLot(){ 
	  $query = "SELECT * FROM Article GROUP BY idLot";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $res;
	 }
	
	public Static function gettAllArticleGroupByMarque(){ 
	  $query = "SELECT * FROM Article GROUP BY idMarque";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $res;
	 }
	 
	public Static function getLotByCertificat(){ 
	  $query = "SELECT * FROM Article WHERE certificat=true";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $lot = Lot::getLotById((int)$row[1]);
	  $marque = Marque::getMarqueById((int)$row[2]);
	  $article = new Article($lot,$marque,(String)$row[3],(int)$row[4],(int)$row[5],(String)$row[6],(int)$row[7]
	  ,(String)$row[8],(int)$row[9],(string)$row[10],(string)$row[11],(string)$row[12]);
	  $article->setId((int)$row[0]);
	  return $article;

	 }
	 
	public Static function getArticleByMarque($libelleMarque){
		$marque = Marque::getMarqueByLibelle($libelleMarque);
		$query = "SELECT * FROM Article WHERE idMarque=".$marque->getId();
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
		return res;
	 }
	 
	 public function getArticleByLot($idLot){
		$query = "SELECT * FROM Article WHERE idLot=".$idLot;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	 
		return res;
	 }
	 
	public function getArticleByPtvMin($ptvMin){
		$query = "SELECT * FROM Article WHERE ptvMin >=".$ptvMin;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	 
		return res;
	 }
	 
	public function getArticleByPtvMax($ptvMin){
		$query = "SELECT * FROM Article WHERE ptvMax <=".$ptvMax;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	 
		return res;
	 }
	 
	public function getArticleByPtvMinAndMax($ptvMin,$ptvMax){
		$query = "SELECT * FROM Article WHERE ptvMin >=".$ptvMin."AND ptvMax <=".$ptvMax;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	 
		return res;
	 }
	
	public function updatePtvMin($ptvMin){
		$id = $this->getId();
		$query = "UPDATE Article SET ptvMin =".$ptvMin." WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setPtvMin($ptvMin);
	 }
	 
	public function updatePtvMax($ptvMax){
		$id = $this->getId();
		$query = "UPDATE Article SET ptvMax =".$ptvMax." WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setPtvMax($ptvMax);
	 }
	 
	 public function updateSurface($surface){
		$id = $this->getId();
		$query = "UPDATE Article SET surfaceVoile =".$surface." WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setSurfaceVoile($surface);
	 }
	 
	 public function updateTypeArticle($typeArticle){
		$id = $this->getId();
		$query = "UPDATE Article SET typeArticle ='$typeArticle' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setTypeArticle($typeActicle);
	 }
	 
	public function updateTypeAccessoire($typeAccessoire){
		$id = $this->getId();
		$query = "UPDATE Article SET typeAccessoire ='$typeAccessoire' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setTypeAccessoire($typeAccessoire);
	 }
	 
	public function updateCouleurVoile($couleurVoile){
		$id = $this->getId();
		$query = "UPDATE Article SET couleurVoile ='$couleurVoile' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setCouleurVoile($couleurVoile);
	 }
	 
	public function updateHeureVoile($heureVoile){
		$id = $this->getId();
		$query = "UPDATE Article SET heureVoile ='$heureVoile' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setHeureVoile($heureVoile);
	 }
	 
	public function updateCertificat($certificat){
		$id = $this->getId();
		$query = "UPDATE Article SET certificat ='$certificat' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setCertificat($certificat);
	 }
	 
	public function updateTypeProtectionSelette($typeProtectionSelette){
		$id = $this->getId();
		$query = "UPDATE Article SET typeProtectionSelette ='$typeProtectionSelette' WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();	
		$this->setTypeProtectionSelette($typeProtectionSelette);
	 }
}
?>