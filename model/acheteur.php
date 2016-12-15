<?php
//Cette classe représente les acheteurs
require_once('db.php');

class Acheteur
{
  private $_idAcheteur;
  private $_nom;
  private $_prenom;
  private $_tel;
  private $_email;
  private $_adresse;
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 
	 public function __construct($nom,$prenom,$tel,$email,$adresse){	 
		$this->setNom($nom);
		$this->setPrenom($prenom); 
		$this->setTel($tel); 
		$this->setEmail($email); 
		$this->setAdresse($adresse); 		
	}
  
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

	// Getter ID 
	 public function getId(){
		return $this->_idAcheteur;
	  }
  
	 // Setter ID 
	 public function setId($id){
		return $this->_idAcheteur = $id;
	 }
	 
	//Getter nom 
	 public function getNom(){
		return $this->_nom;
	  }

	//Setter nom 
	 public function setNom($nom){
		if (!is_String($nom)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le nom d\'un acheteur doit être une chaine de charactère', E_USER_WARNING);
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
		  trigger_error('Le prenom d\'un acheteur doit être une chaine de charactère', E_USER_WARNING);
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
		  trigger_error('Le tel d\'un acheteur doit être une chaine de charactère', E_USER_WARNING);
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
		  trigger_error('Le email d\'un acheteur doit être une chaine de charactère', E_USER_WARNING);
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
		  trigger_error('Le adresse d\'un acheteur doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_adresse = $adresse;
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
	  $query = "INSERT INTO Acheteur (idAcheteur, nom, prenom, telephone, mail, adresse)
	  VALUES ('','".$nom."','".$prenom."','".$tel."','".$email."','".$adresse."')";
	   
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
	 
	/* 
		public static function delete($idAcheteur) -> delete en base de données l'instance ayant l'id $id
		Input : $id 
	    Output : Void
	*/ 
	
	public static function delete($idAcheteur) {
		$query = "DELETE FROM Acheteur WHERE idAcheteur=".$idAcheteur;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
	}
	
	
	/* 
		public Static function getAcheteurById($id) -> get en base de données l'instance ayant l'id $id
		Input : $id 
	    Output : l'acheteur ayant l'id $id
	*/ 
	
	public Static function getAcheteurById($id){
		 
	  $query = "SELECT * FROM Acheteur WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	 }
	 
	 
	 /* 
		public Static function getAcheteurByMail($mail) -> get en base de données l'instance ayant l'email $mail
		Input : $mail
	    Output : l'acheteur ayant l'email $mail
	*/
	
	public Static function getAcheteurByMail($mail){
	  $query = "SELECT * FROM Acheteur WHERE mail = '$mail'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	}
	
	/* 
		public Static function getIdAcheteurByMail($mail) -> get en base de données l'id de l'acheteurnce ayant l'email $mail
		Input : $mail
	    Output : l'id de l'acheteur ayant l'email $mail
	*/
	
	public static function getIdAcheteurByMail($mail) {
	  $query = "SELECT idAcheteur FROM 	Acheteur WHERE mail='$mail'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return $row;
	}
	
	
	/* 
		public Static function acheteurExistByMail($mail) -> Verifie en base de données sil'acheteur ayant l'email $mail existe
		Input : $mail
	    Output : 1 s'il existe sinon 0
	*/
	
	public static function acheteurExistByMail($mail){
	  $query = "SELECT * FROM Acheteur WHERE mail='$mail'";
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
		public static function updateNomById($id,$nom) -> update en base de données le nom de l'acheteur ayant l'id $id
		Input : $nom et $id
	    Output : Void
	*/
	
	public static function updateNomById($id,$nom) {
	  $query = "UPDATE Acheteur SET nom ='$nom' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 } 
	
	/* 
		public static function updatePrenomById($id,$prenom) -> update en base de données le prenom de l'acheteur ayant l'id $id
		Input : $prenom et $id
	    Output : Void
	*/
	
	public static function updatePrenomById($id,$prenom) {
	  $query = "UPDATE Acheteur SET prenom ='$prenom' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 } 
	 
	 
	
	/* 
		public static function updateMailyId($id,$mail) -> update en base de données le mail de l'acheteur ayant l'id $id
		Input : $mail et $id
	    Output : Void
	*/
	
	public static function updateMailById($id,$mail) {
	  $query = "UPDATE Acheteur SET mail ='$mail' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 } 
	
	
	/* 
		public static function updateAddresseById($id,$adresse) -> update en base de données l'adresse de l'acheteur ayant l'id $id
		Input : $adresse et $id
	    Output : Void
	*/
	
	public static function updateAdresseById($id,$adresse) {
	  $query = "UPDATE Acheteur SET adresse ='$adresse' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	
	/* 
		public static function updateTelById($id,$tel) -> update en base de données le telephone de l'acheteur ayant l'id $id
		Input : $tel et $id
	    Output : Void
	*/
	
	public static function updateTelById($id,$tel) {
	  $query = "UPDATE Acheteur SET telephone ='$tel' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 
}

?>