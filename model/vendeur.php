<?php
//Cette classe représente les vendeurs
require_once('db.php');

class Vendeur
{
  private $_idVendeur;
  private $_nom;
  private $_prenom;
  private $_tel;
  private $_email;
  private $_adresse;
  private $_type;
  private $_numPre;
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 
	 public function __construct($nom,$prenom,$tel,$email,$adresse,$type,$numPre){	 
		$this->setNom($nom);
		$this->setPrenom($prenom); 
		$this->setTel($tel); 
		$this->setEmail($email); 
		$this->setAdresse($adresse); 	
		$this->setTypeVendeur($type);
		$this->setNumPre($numPre);
	}
  
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

	// Getter ID 
	 public function getId(){
		return $this->_idVendeur;
	  }
  
	 // Setter ID 
	 public function setId($id){
		return $this->_idVendeur = $id;
	 }
	 
	//Getter nom 
	 public function getNom(){
		return $this->_nom;
	  }

	//Setter nom 
	 public function setNom($nom){
		if (!is_String($nom)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le nom d\'un vendeur doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_nom = $nom;
	  }
	  
	 //Getter prenom 
	 public function getPrenom(){
		return $this->_prenom;
	  }

	//Setter prenom 
	 public function setPrenom($prenom){
		if (!is_String($prenom)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le prenom d\'un vendeur doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_prenom = $prenom;
	  }
	  
	 //Getter tel 
	 public function getTel(){
		return $this->_tel;
	  }

	//Setter tel 
	 public function setTel($tel){
		if (!is_String($tel)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le tel d\'un vendeur doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_tel = $tel;
	  }
	  
	//Getter email 
	 public function getEmail(){
		return $this->_email;
	  }

	//Setter email 
	 public function setEmail($email){
		if (!is_String($email)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le email d\'un vendeur doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_email = $email;
	  }
	  
	 //Getter adresse 
	 public function getAdresse(){
		return $this->_adresse;
	  }

	//Setter adresse 
	 public function setAdresse($adresse){
		if (!is_String($adresse)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le type d\'un vendeur doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_adresse = $adresse;
	  }
	  
	 //Getter type 
	 public function getTypeVendeur(){
		return $this->_type;
	  }

	//Setter type 
	 public function setTypeVendeur($type){
		if (!is_String($type)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le type d\'un vendeur doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_type = $type;
	 }
	 
	//Getter numPre 
	 public function getNumPre(){
		return $this->_numPre;
	  }

	//Setter numPre 
	 public function setNumPre($numPre){
		if (!is_String($numPre)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le numPre d\'un vendeur doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_numPre = $numPre;
	 
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
	  $nom = $this->getNom();
	  $prenom = $this->getPrenom();
	  $tel = $this->getTel();
	  $email = $this->getEmail();
	  $adresse = $this->getAdresse();
	  $type = $this->getTypeVendeur();
	  $numPre = $this->getNumPre();
	  $query = "INSERT INTO Vendeur (idVendeur, nom, prenom, telephone, mail, adresse, type, numPre)
	  VALUES ('','".$nom."','".$prenom."','".$tel."','".$email."','".$adresse."','".$type."','".$numPre."')";
	   
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
	 
	/* 
		public static function delete($id) -> delete en base de données l'instance ayant l'id $id
		Input : $id 
	    Output : Void
	*/ 
	
	public static function delete($id) {
		$query = "DELETE FROM Vendeur WHERE idVendeur=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
	}
	
	
	/* 
		public Static function getVendeurById($id) -> get en base de données l'instance ayant l'id $id
		Input : $id 
	    Output : le vendeur ayant l'id $id
	*/ 
	
	public Static function getVendeurById($id){
		 
	  $query = "SELECT * FROM Vendeur WHERE idVendeur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	 }
	 
	 
	 /* 
		public Static function getVendeurByMail($mail) -> get en base de données l'instance ayant l'email $mail
		Input : $mail
	    Output : le vendeur ayant l'email $mail
	*/
	
	public Static function getVendeurByMail($mail){
	  $query = "SELECT * FROM Vendeur WHERE mail = '$mail'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	}
	
 /* 
		public Static function getVendeurByNumPre($numPre) -> get en base de données l'instance ayant le numPreinscription $numPre
		Input : $numPre
	    Output : le vendeur ayant le numPre $numPre
	*/
	
	public Static function getVendeurByNumPre($numPre){
	  $query = "SELECT * FROM Vendeur WHERE numPre = '$numPre'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	}
	
	 /* 
		public Static function getVendeurByType($type) -> get en base de données les instances ayant le type $type
		Input : $type
	    Output : les vendeurs du type $type
	*/
	
	public Static function getVendeurByType($Type){
	  $query = "SELECT * FROM Vendeur WHERE type = '$type'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  return $res;
	}
	
	/* 
		public Static function getIdVendeurByMail($mail) -> get en base de données l'id du vendeur ayant l'email $mail
		Input : $mail
	    Output : l'id du vendeur ayant l'email $mail
	*/
	
	public static function getIdVendeurByMail($mail) {
	  $query = "SELECT idVendeur FROM Vendeur WHERE mail='$mail'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	}
	
	
	/* 
		public Static function VendeurExistByMail($mail) -> Verifie en base de données si le vendeur ayant l'email $mail existe
		Input : $mail
	    Output : 1 s'il existe sinon 0
	*/
	
	public static function vendeurExistByMail($mail){
	  $query = "SELECT * FROM Vendeur WHERE mail='$mail'";
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
	
	/* 
		public static function updateNomById($id,$nom) -> update en base de données le nom du vendeur ayant l'id $id
		Input : $nom et $id
	    Output : Void
	*/
	
	public static function updateNomById($id,$nom) {
	  $query = "UPDATE Vendeur SET nom ='$nom' WHERE idVendeur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 } 
	
	/* 
		public static function updatePrenomById($id,$prenom) -> update en base de données le prenom du vendeur ayant l'id $id
		Input : $prenom et $id
	    Output : Void
	*/
	
	public static function updatePrenomById($id,$prenom) {
	  $query = "UPDATE Vendeur SET prenom ='$prenom' WHERE idVendeur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 } 
	 
	 
	
	/* 
		public static function updateMailyId($id,$mail) -> update en base de données le mail du vendeur ayant l'id $id
		Input : $mail et $id
	    Output : Void
	*/
	
	public static function updateMailById($id,$mail) {
	  $query = "UPDATE Vendeur SET mail ='$mail' WHERE idVendeur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 } 
	
	
	/* 
		public static function updateAddresseById($id,$adresse) -> update en base de données l'adresse du vendeur ayant l'id $id
		Input : $adresse et $id
	    Output : Void
	*/
	
	public static function updateAdresseById($id,$adresse) {
	  $query = "UPDATE Vendeur SET adresse ='$adresse' WHERE idVendeur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	
	/* 
		public static function updateTelById($id,$tel) -> update en base de données le telephone du vendeur ayant l'id $id
		Input : $tel et $id
	    Output : Void
	*/
	
	public static function updateTelById($id,$tel) {
	  $query = "UPDATE Vendeur SET telephone ='$tel' WHERE idVendeur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
		/* 
		public static function updateTypeById($id,$tel) -> update en base de données le type du vendeur ayant l'id $id
		Input : $type et $id
	    Output : Void
	*/
	
	public static function updateTypeById($id,$type) {
	  $query = "UPDATE Vendeur SET type ='$type' WHERE idVendeur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
		/* 
		public static function updateNumPreById($id,$tel) -> update en base de données le num de préinscription du vendeur ayant l'id $id
		Input : $numPre et $id
	    Output : Void
	*/
	
	public static function updateNumPreById($id,$numPre) {
	  $query = "UPDATE Vendeur SET telephone ='$numPre' WHERE idVendeur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
}
?>