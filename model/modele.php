<?php
//Cette classe représente les modèles des articles vendus par l'ecole saint Hilare
require_once('db.php');

class Modele
{
  private $_idModele;
  private $_libelle;
  private $_categorie;
  private $_homologation;
   
   
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 
	 public function __construct($id, $libelle, $categorie, $homologation){	 
	    $this->setId($id);
		$this->setLibelle($libelle); // Initialisation du libelle
		$this->setCategorie($categorie); // Initialisation de la categorie
		$this->setHomologation($homologation); // Initialisation de l'homologation
	}
  
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

	// Getter ID 
	 public function getId(){
		return $this->_idModele;
	  }
	  
	// Getter ID 
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
	 
	//Getter categorie 
	 public function getCategorie(){
		return $this->_categorie; 
	 }
 
	 //Setter categorie
	 public function setCategorie($categorie){
		if (!is_String($categorie)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('La categorie d\'un modele doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_categorie = $categorie;
	  }
	  
	 //Getter homologation
	 public function getHomologation(){
		 return $this->_homologation;
	 }
	 
	 //Setter homologation
	 public function setHomologation($homologation){
		if (!is_String($homologation)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('L\'homologation d\'un modele doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_homologation = $homologation;
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
	  
	  $query = "INSERT INTO Modele (idModele, libelle, categorie, homologation)
	  VALUES ('','".$libelle."','".$categorie."','".$homologation."')";
	  
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
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
	  return $row;
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
	  return $res;
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
	 
	 public Static function deleteModeleById($id) {
	  $query = "DELETE FROM Modele WHERE idModele=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
}
Modele::deleteModeleById(3);

?>