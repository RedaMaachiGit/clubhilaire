<?php

//Cette classe représente les lot des articles vendus par l'ecole saint Hilare
require_once('db.php');
require_once('Vendeur.php');
require_once('Acheteur.php');


class Lot
{
  private $_idLot;
  private $_numeroCoupon;
  private $_numeroLotVendeur;
  private $_prix;
  private $_status;
  private $_acheteur;
  private $_vendeur;
  private $_dateDepot;
  private $_dateVente;
   
   
   
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 
	 public function __construct($numeroCoupon, $numeroLotVendeur, $prix, $vendeur){	 
		$this->setCoupon($numeroCoupon);
		$this->setNumeroLotVendeur($numeroLotVendeur);
		$this->setPrix($prix); 
		$this->setStatus("En vente");
		$this->setVendeur($vendeur);
		$today = date("d-m-Y H:i:s");  
		$this->setDateDepot($today);
	}
  
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 

	// Getter ID 
	 public function getId(){
		return $this->_idLot;
	  }
	  
	// Setter ID 
	 public function setId($id){
		$this->_idLot = $id;
	 }
	 
	 // Getter ID 
	 public function getStatus(){
		return $this->_status;
	  }
	  
	// Setter ID 
	 public function setStatus($status){
		$this->_status = $status;
	 }
	 
	//Getter numeroCoupon 
	 public function getCoupon(){
		return $this->_numeroCoupon;
	  }
	 
	//Setter coupon 
	 public function setCoupon($coupon){
		if (!is_String($coupon)) // S'il ne s'agit pas d'unne chaine de charatère
		{
		  trigger_error('Le coupon d\'un lot doit être une chaine de charactère', E_USER_WARNING);
		  return;
		}
		$this->_numeroCoupon = $coupon;
	  }
	  
	 //Getter numeroLotVendeur 
	 public function getNumeroLotVendeur(){
		return $this->_numeroLotVendeur;
	  }
	 
	//Setter numeroLotVendeur 
	 public function setNumeroLotVendeur($numeroLotVendeur){
		$this->_numeroLotVendeur = $numeroLotVendeur;
	  }
	 
	 
	//Getter prix 
	 public function getPrix(){
		return $this->_prix; 
	 }
 
	 //Setter prix
	 public function setPrix($prix){
		$this->_prix = $prix;
	  }
	  
	 //Getter acheteur
	 public function getAcheteur(){
		 return $this->_acheteur;
	 }
	 
	 //Setter acheter
	 public function setAcheteur($acheteur){
		$this->_acheteur = $acheteur;
	  }
	  
	 //Getter acheteur
	 public function getVendeur(){
		 return $this->_vendeur;
	 }
	 
	 //Setter acheter
	 public function setVendeur($vendeur){
		$this->_vendeur = $vendeur;
	  }
	  
	//Setter dateDepot
	public function setDateDepot($date){
		$this->_dateDepot = $date;
	}
	
	//getter dateDepot
	public function getDateDepot(){
		return $this->_dateDepot;
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
	  $coupon = $this->getCoupon();
	  $numeroLotVendeur = $this->getNumeroLotVendeur();
	  $prix = $this->getPrix();
	  $status = $this->getStatus();
	  $acheteur = $this->getAcheteur();
	  $vendeur = $this->getVendeur();
	  $dateDepot = $this->getDateDepot();
	  $idA=null;
	  $idV=null;
	  if($acheteur!=null){
		  $idA=$acheteur->getId();
	  }
	  if($vendeur!=null){
		  $idV=$vendeur->getId();
	  }
	  $query = "INSERT INTO Lot (idLot, numeroCoupon, numeroLotVendeur, prixVente, statut, idAcheteur, idVendeur,dateDepot)
	  VALUES ('','".$coupon."','".$numeroLotVendeur."','".$prix."','".$status."','".$idA."','".$idV."','".$dateDepot."')";	  
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $idLot = $conn->insert_id;
	  $this->setId($idLot);
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
		public Static function getLotById($id) -> get en base de données l'instance ayant l'id $id
		Input : $id 
	    Output : le vendeur lot l'id $id
	*/ 
	
	public Static function getLotById($id){ 
	  $query = "SELECT * FROM Lot WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $vendeur = Vendeur::getVendeurById((int)$row[6]);
	  $acheteur = Acheteur::getAcheteurById((int)$row[5]);
	  $lot = new Lot((String)$row[1],(String)$row[2],(int)$row[3],$vendeur);
	  $lot->setId((int)$row[0]);
	  $lot->setStatus((String)$row[4]);
	  $lot->setAcheteur($acheteur);
	  return $lot;
	 }
	 
	public Static function getLotByCoupon($coupon){ 
	  $query = "SELECT * FROM Lot WHERE numeroCoupon=".$coupon;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $vendeur = Vendeur::getVendeurById((int)$row[6]);
	  $acheteur = Acheteur::getAcheteurById((int)$row[5]);
	  $lot = new Lot((String)$row[1],(String)$row[2],(int)$row[3],$vendeur);
	  $lot->setId((int)$row[0]);
	  $lot->setStatus((String)$row[4]);
	  $lot->setAcheteur($acheteur);
	  return $lot;
	 }
	 
	public Static function getLotByStatus($status){ 
	  $query = "SELECT * FROM Lot WHERE status=".$status;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  $vendeur = Vendeur::getVendeurById((int)$row[6]);
	  $acheteur = Acheteur::getAcheteurById((int)$row[5]);
	  $lot = new Lot((String)$row[1],(String)$row[2],(int)$row[3],$vendeur);
	  $lot->setId((int)$row[0]);
	  $lot->setStatus((String)$row[4]);
	  $lot->setAcheteur($acheteur);
	  return $lot;
	 }
	 
	 public function updatePrix($prix){
	  $id = $this->getId();
	  $query = "UPDATE Lot SET prix ='$prix' WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setPrix($prix);
	  $db->close();	 
	 }
	
	public function updateStatus($status){
	  $id = $this->getId();
	  $query = "UPDATE Lot SET status ='$status' WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setStatus($status);
	  $db->close();	 
	 }
	 
	 public function updateNumeroLotVendeur($numeroLotVendeur){
	  $id = $this->getId();
	  $query = "UPDATE Lot SET numeroLotVendeur ='$numeroLotVendeur' WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setNumeroLotVendeur($numeroLotVendeur);
	  $db->close();	 
	 }
}
?>