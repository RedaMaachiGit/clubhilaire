<?php
//Cette classe représente les marques des articles vendus par l'ecole saint Hilare
require_once('db.php');

class Marque
{
  private $_idMarque;
  private $_libelle;
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 
	 public function __construct($libelle){	 
		$this->setLibelle($libelle); // Initialisation du libelle
	}
  
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

	// Getter ID 
	 public function getId(){
		return $this->_idMarque;
	  }

	  
	 // Setter ID 
	 public function setId($id){
		return $this->_idMarque = $id;
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
	  
	  $query = "INSERT INTO Marque (idMarque, libelle)
	  VALUES ('','".$libelle."')";
	  
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
	/* 
		public static function getMarqueById($id) -> Recherche en bd la marque ayant l'id $id
		Input : l'id de la marque voulu
	    Output : la marque en base de donnée ayant l'id passé en input
	*/
	
	 public Static function getMarqueById($id){
		 
	  $query = "SELECT * FROM Marque WHERE idMarque=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	 }
	 
	 
	/* 
		public Static function getMarqueByLibelle($libelle) -> Recherche en bd les marques ayant le libelle $libelle
		Input : le libelle voulu
	    Output : les marques en base de donnée ayant le libelle passé en input
	*/	
	
	 public Static function getMarqueByLibelle($libelle){
	  $query = "SELECT * FROM Marque WHERE libelle = '$libelle'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  return $res;
	 }
	 
	 public Static function deleteMarqueById($id) {
	  $query = "DELETE FROM Marque WHERE idMarque=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
	 
	 public static function getIdMarqueByName($nameMarque) {
	  $query = "SELECT idMarque FROM Marque WHERE libelle='$nameMarque'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	}
	
	public function getModeleByMarque(){
	  $idMarque = $this->getId();
	  $query = "SELECT * FROM Modele WHERE idMarque=".$idMarque;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  return $res;
	}
	
	public static function marqueExistByLibelle($libelle){
	  $query = "SELECT * FROM Marque WHERE libelle='$libelle'";
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
	
	public static function updateLibelleById($id,$libelle) {
	  $query = "UPDATE Marque SET libelle ='$libelle' WHERE idMarque=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
}


?>