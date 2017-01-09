<?php
//Cette classe représente les modèles des articles vendus par l'ecole saint Hilare
require_once('db.php');
require_once('marque.php');


class Modele
{
  private $_idModele;
  private $_libelle;
  private $_homologation;
  private $_categorie;
  private $_marque;
   
   
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 
	 public function __construct($libelle, $homologation,$marque,$categorie){	 
		$this->setLibelle($libelle); // Initialisation du libelle
		$this->setHomologation($homologation); // Initialisation de l'homologation
		$this->setMarque($marque);
		$this->setCategorie($categorie);
	}
  
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

	// Getter ID 
	 public function getId(){
		return $this->_idModele;
	  }
	  
	// Setter ID 
	 public function setId($id){
		return $this->_idModele = $id;
	 }
	 
	//Getter libelle 
	 public function getLibelle(){
		return $this->_libelle;
	  }
	 
	//Setter libelle 
	 public function setLibelle($libelle){
		if (!is_String($libelle)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le libelle d\'un modele doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_libelle = $libelle;
	  }
	 
	  
	 //Getter homologation
	 public function getHomologation(){
		 return $this->_homologation;
	 }
	 
	 //Setter homologation
	 public function setHomologation($homologation){
		$this->_homologation = $homologation;
	  }
	  
	 //Getter marque
	 public function getMarque(){
		 return $this->_marque;
	 }
	 
	 //Setter marque
	 public function setMarque($marque){
		$this->_marque = $marque;
	  }
	  
	//Getter categorie
	 public function getCategorie(){
		 return $this->_categorie;
	 }
	 
	 //Setter marque
	 public function setCategorie($categorie){
		$this->_categorie = $categorie;
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
	  $libelle = $this->getLibelle();
	  $categorie = $this->getCategorie();
	  $homologation = $this->getHomologation();
	  $idMarque = $this->getMarque()->getId();
	  
	  $query = "INSERT INTO Modele (libelle, homologation,idMarque)
	  VALUES ('".$libelle."','".$homologation."','".$idMarque."')";
	  
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $idModele = $conn->insert_id;
	  $this->setId($idModele);
	  $db->close();
	 }
	 
	/* 
		public static function getModeleById($id) -> Recherche en bd le modèle ayant l'id $id
		Input : l'id du modele voulu
	    Output : le modele en base de donnée ayant l'id passé en input
	*/
	
	 public Static function getModeleById($id){	 
	  $query = "SELECT * FROM Modele WHERE idModele=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $marque = Marque::getMarqueById((int)$row[4]);
	  $modele = new Modele((String)$row[1],(String)$row[2],$marque,(String)$row[3]);
	  $modele->setId((int)$row[0]);
	  return $modele;
	 }
	 
	 
	/* 
		public Static function getModeleByLibelle($libelle) -> Recherche en bd les modèles ayant le libelle $libelle
		Input : le libelle voulu
	    Output : les modele en base de donnée ayant le libelle passé en input
	*/	
	
	 public Static function getModeleByLibelle($libelle){
	  $query = "SELECT * FROM Modele WHERE libelle = '$libelle'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $marque = Marque::getMarqueById((int)$row[4]);
	  $modele = new Modele((String)$row[1],(String)$row[2],$marque,(String)$row[3]);
	  $modele->setId((int)$row[0]);
	  return $modele;
	 }
	 
	 /* 
		public Static function getModeleByCategorie($categorie) -> Recherche en bd les modèles appartenant à la categorie $categorie
		Input : la categorie voulu
	    Output : les modele en base de donnée ayant la categorie passé en input
	*/	
	
	 public Static function getModeleByCategorie($categorie){
	  $query = "SELECT * FROM Modele WHERE categorie = '$categorie'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  return $res;
	 }
	 
	 /* 
		public Static function getModeleByHomologation($homologation) -> Recherche en bd les modèles ayant l'homologation $homologation
		Input : l'homologation voulu
	    Output : les modele en base de donnée ayant l'homologation passé en input
	*/	
	
	 public Static function getModeleByHomologation($homologation){
	  $query = "SELECT * FROM Modele WHERE homologation = '$homologation'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  return $res;
	 }
	 
	public static function modeleExistByLibelle($libelle){
	  $query = "SELECT * FROM Modele WHERE libelle='$libelle'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  echo($res->num_rows);
	  if($res->num_rows == 0 ){
		  return false;
	  }else{
		  return true;
	  }
	}
	 
	 public function delete() {
	  $id = $this>getId();
	  $query = "DELETE FROM Modele WHERE idMarque=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
	 public function updateLibelle($libelle) {
	  $id = $this>getId();
	  $query = "UPDATE Modele SET libelle ='$libelle' WHERE idModele=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setLibelle($libelle);
	  $db->close();
	 }

	 
	 public function updateHomologation($homologation) {
	  $id = $this>getId();
	  $query = "UPDATE Modele SET homologation ='$homologation' WHERE idModele=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setHomologation($homologation);
	  $db->close();
	 }
	 
}

?>