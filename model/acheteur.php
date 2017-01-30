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
	  $query = "INSERT INTO acheteur (nom, prenom, telephone, mail, adresse)
	  VALUES ('".$nom."','".$prenom."','".$tel."','".$email."','".$adresse."')";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $idAcheteur = $conn->insert_id;
	  $this->setId($idAcheteur);
	  $db->close();
	 }
	 
	 
	/* 
		public function delete() -> delete en base de données l'instance
		Input : void
	    Output : Void
	*/ 
	
	public function delete() {
		$id = $this->getId();
		$query = "DELETE FROM acheteur WHERE idAcheteur=".$id;
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
	  $query = "SELECT * FROM acheteur WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $acheteur = new Acheteur((String)$row[1],(String)$row[1],(String)$row[1],(String)$row[1],(String)$row[1]);
	  $acheteur->setId((int)$row[1]);
	  return $acheteur;
	 }
	 
	 
	 /* 
		public Static function getAcheteurByMail($mail) -> get en base de données l'instance ayant l'email $mail
		Input : $mail
	    Output : l'acheteur ayant l'email $mail
	*/
	
	public Static function getAcheteurByMail($mail){
	  $query = "SELECT * FROM acheteur WHERE mail = '$mail'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $acheteur = new Acheteur((String)$row[1],(String)$row[1],(String)$row[1],(String)$row[1],(String)$row[1]);
	  $acheteur->setId((int)$row[1]);
	  return $acheteur;
	}
	
	/* 
		public Static function getIdAcheteurByMail($mail) -> get en base de données l'id de l'acheteurnce ayant l'email $mail
		Input : $mail
	    Output : l'id de l'acheteur ayant l'email $mail
	*/
	
	public static function getIdAcheteurByMail($mail) {
	  $query = "SELECT idAcheteur FROM 	acheteur WHERE mail='$mail'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  return (int)$row[0];
	}
	
	
	/* 
		public Static function acheteurExistByMail($mail) -> Verifie en base de données sil'acheteur ayant l'email $mail existe
		Input : $mail
	    Output : 1 s'il existe sinon 0
	*/
	
	public static function acheteurExistByMail($mail){
	  $query = "SELECT * FROM acheteur WHERE mail='$mail'";
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
		public function updateNom($nom) -> update en base de données le nom de l'acheteur
		Input : $nom
	    Output : Void
	*/
	
	public static function updateNom($nom) {
	  $query = "UPDATE acheteur SET nom ='$nom' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setNom($nom);
	  $db->close();
	 } 
	
	/* 
		public function updatePrenom($prenom) -> update en base de données le prenom de l'acheteur
		Input : $prenom
	    Output : Void
	*/
	
	public static function updatePrenom($prenom) {
	  $id = $this->getId();
	  $query = "UPDATE acheteur SET prenom ='$prenom' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setPrenom($prenom);
	  $db->close();
	 } 
	 
	 
	
	/* 
		public function updateMail(,$mail) -> update en base de données le mail de l'acheteur
		Input : $mail
	    Output : Void
	*/
	
	public static function updateMail($mail) {
   	  $id = $this->getId();
	  $query = "UPDATE acheteur SET mail ='$mail' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setEmail($mail);
	  $db->close();
	 } 
	
	
	/* 
		public function updateAddresse($adresse) -> update en base de données l'adresse de l'acheteur
		Input : $adresse
	    Output : Void
	*/
	
	public function updateAdresse($adresse) {
	  $id = $this->getId();
	  $query = "UPDATE acheteur SET adresse ='$adresse' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $this->setAdresse($adresse);
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	
	/* 
		public function updateTel($tel) -> update en base de données le telephone de l'acheteur
		Input : $tel
	    Output : Void
	*/
	
	public function updateTel($tel) {
	  $id = $this->getId();
	  $query = "UPDATE acheteur SET telephone ='$tel' WHERE idAcheteur=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setTel($tel);
	  $db->close();  
	 }
	 
}
?>