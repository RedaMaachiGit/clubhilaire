<?php
//Cette classe représente les numéros de coupon
require_once('db.php');

class Coupon
{
  private $_debut;
  private $_fin;
  private $_courant;
  private $_obselete;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	 public function __construct($debut,$fin,$courant,$obselete){
		$this->setDebut($debut);
		$this->setFin($fin);
		$this->setCourant($courant);
		$this->setObselete($obselete);
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// Getter ID
	 public function getDebut(){
		return $this->_debut;
	  }

	 // Setter ID
	 public function setDebut($debut){
		return $this->_debut = $debut;
	 }

	//Getter nom
	 public function getFin(){
		return $this->_fin;
	  }

	//Setter nom
	 public function setFin($fin){
		$this->_fin = $fin;
	  }

	 //Getter prenom
	 public function getCourant(){
		return $this->_courant;
	  }

	//Setter prenom
	 public function setCourant($courant){
		$this->_courant = $courant;
	  }

	 //Getter tel
	 public function getObselete(){
		return $this->_obselete;
	  }

	//Setter tel
	 public function setObselete($obselete){
		$this->_obselete = $obselete;
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
	  $debut = $this->getDebut();
	  $fin = $this->getFin();
	  $courant = $this->getCourant();
	  $obselete = $this->getObselete();

	  $query = "INSERT INTO coupons (debut, fin, obselete, current)
	  VALUES ('".$debut."','".$fin."','".$courant."','".$obselete."')";

	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  // $idVendeur = $conn->insert_id;
	  // $this->setId($idVendeur);
	  $db->close();
	 }


	public function updateCoupon($debut,$fin,$courant,$obselete) {
	  $query = "UPDATE coupons SET debut ='$debut' , fin ='$fin', obselete='$obselete', current='$courant' WHERE idcoupon=1";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }

}
?>
