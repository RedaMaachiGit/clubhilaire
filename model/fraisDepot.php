<?php
//Cette classe représente lesfrais de dépot des lots vendus par l'ecole saint Hilare
require_once('db.php');



class FraisDepot
{
  private $_idFraisDepot;
  private $_typePaiement;
  private $_montant;
  private $_nom;
  private $_prenom;
  private $_telephone;
  private $_numero;
  private $_commentaire;
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 
	 public function __construct($typePaiement,$montant,$nom,$prenom,$telephone,$numero,$commentaire){	 
		$this->setTypePaiement($typePaiement); 
		$this->setMontant($montant); 
		$this->setNom($nom);
		$this->setPrenom($prenom);
		$this->setTelephone($telephone);
		$this->setNumero($numero);
		$this->setCommentaire($commentaire);
	}
  
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

	// Getter ID 
	 public function getId(){
		return $this->_idFraisDepot;
	  }
	  
	// Setter ID 
	 public function setId($id){
		return $this->_idFraisDepot = $id;
	 }
	 
	//Getter typePaiement 
	 public function getTypePaiement(){
		return $this->_typePaiement;
	  }
	 
	//Setter typePaiement 
	 public function setTypePaiement($typePaiement){
		$this->_typePaiement = $typePaiement;
	  }
	 
	//Getter montant
	 public function getMontant(){
		 return $this->_montant;
	 }
	 
	//Setter montant
	 public function setMontant($montant){
		$this->_montant = $montant;
	}
	  
	 //Getter Nom
	 public function getNom(){
		 return $this->_nom;
	 }
	 
	 //Setter nom
	 public function setNom($nom){
		$this->_nom = $nom;
	  }
	  
	 //Getter prenom
	 public function getPrenom(){
		 return $this->_prenom;
	 }
	 
	 //Setter prenom
	 public function setPrenom($prenom){
		$this->_prenom = $prenom;
	}
	  
	//Getter telephone
	 public function getTelephone(){
		 return $this->_telephone;
	 }
	 
	 //Setter telephone
	 public function setTelephone($telephone){
		$this->_telephone = $telephone;
	  }
	  
	//Getter numero
	 public function getNumero(){
		 return $this->_numero;
	 }
	 
	 //Setter numero
	 public function setNumero($numero){
		$this->_numero = $numero;
	  }
	  
	 //Getter commentaire
	 public function getCommentaire(){
		 return $this->_commentaire;
	 }
	 
	 //Setter commentaire
	 public function setCommentaire($commentaire){
		$this->_commentaire = $commentaire;
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
	  $typePaiement = $this->getTypePaiement();
	  $montant = $this->getMontant();
	  $nom = $this->getNom();
	  $prenom = $this->getPrenom();
	  $telephone = $this->getTelephone();
	  $numero = $this->getNumero();
	  $commentaire = $this->getCommentaire();
	  $query = "INSERT INTO fraisDepot (typePaiement, montant,nom,prenom,telephone,numero,commentaire)
	  VALUES ('".$typePaiement."','".$montant."','".$nom."','".$prenom."','".$telephone."','".$numero."','".$commentaire."')";	  
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $idModele = $conn->insert_id;
	  $this->setId($idModele);
	  $db->close();
	 }
}

?>