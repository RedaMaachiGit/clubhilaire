<?php
//Cette classe représente lesfrais de dépot des lots vendus par l'ecole saInt Hilare
require_once('db.php');



class Caisse
{
  private $_idPaiement;
  private $_typePaiement;
  private $_montant;
  private $_beneficiaire;
  private $_nomEmetteur;
  private $_prenomEmetteur;
  private $_telephoneEmetteur;
  private $_typeTransaction;
  private $_coupon;
  private $_lot;
  private $_date;
  private $_numero;
  private $_commentaire;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	 public function __construct($typePaiement,$montant,$beneficiare,$nomEmetteur,$prenomEmetteur,$telephoneEmetteur,$typeTransaction,$coupon,$lot,$numero,$commentaire){
		$this->setTypePaiement($typePaiement);
		$this->setMontant($montant);
		$this->setNom($nomEmetteur);
		$this->setPrenom($prenomEmetteur);
		$this->settelephoneEmetteur($telephoneEmetteur);
    $this->settypeTransaction($typeTransaction);
    $this->setcoupon($coupon);
    $this->setBeneficiaire($beneficiare);
    $this->setlot($lot);
    $this->setdate($date);
		$this->setNumero($numero);
		$this->setCommentaire($commentaire);
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// Getter ID
  public function gettypeTransaction(){
    return $this->_typeTransaction;
  };

  public function settypeTransaction($typeTransaction){
    return $this->_typeTransaction = $typeTransaction;
  };
  public function getcoupon(){
    return $this->_coupon;
  };

  public function setcoupon($coupon){
    return $this->_coupon = $coupon;
  };
  public function getlot(){
    return $this->_lot;
  };

  public function setlot($lot){
    return $this->_lot = $lot;
  };
  public function getBeneficiaire(){
    return $this->_beneficiare;
  };

  public function setBeneficiaire($beneficiare){
    return $this->_beneficiare = $beneficiare;
  };
  public function getdate(){
    return $this->_date;
  };

  public function setdate($date){
    return $this->_date = $date;
  };


  public function getId(){
  return $this->_idFraisDepot;
  }

  public function setId($id){
  return $this->_idFraisDepot = $id;
  }

  public function getTypePaiement(){
  return $this->_typePaiement;
  }

  public function setTypePaiement($typePaiement){
  $this->_typePaiement = $typePaiement;
  }

  public function getMontant(){
   return $this->_montant;
  }

  public function setMontant($montant){
  $this->_montant = $montant;
  }

  public function getNom(){
   return $this->_nomEmetteur;
  }

  public function setNom($nomEmetteur){
  $this->_nomEmetteur = $nomEmetteur;
  }

  public function getPrenom(){
   return $this->_prenomEmetteur;
  }

  public function setPrenom($prenomEmetteur){
  $this->_prenomEmetteur = $prenomEmetteur;
  }

  public function gettelephoneEmetteur(){
   return $this->_telephoneEmetteur;
  }

  public function settelephoneEmetteur($telephoneEmetteur){
  $this->_telephoneEmetteur = $telephoneEmetteur;
  }

  public function getNumero(){
   return $this->_numero;
  }

  public function setNumero($numero){
  $this->_numero = $numero;
  }

  public function getCommentaire(){
   return $this->_commentaire;
  }

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
  // public function ecriture(){
  //
  // }
	public function save(){
	  $typePaiement = $this->getTypePaiement();
	  $montant = $this->getMontant();
    $beneficiare = $this->getBeneficiaire();
	  $nom = $this->getNom();
	  $prenom = $this->getPrenom();
	  $telephoneEmetteur = $this->gettelephoneEmetteur();
	  $numero = $this->getNumero();
	  $commentaire = $this->getCommentaire();
    $typeTransaction = $this->gettypeTransaction();
    $lot = $this->getLot();
    $coupon = $this->getCoupon();
	  $query = "INSERT INTO caisse (typePaiement, montant,beneficiaire,nomEmetteur,prenomEmetteur,telephoneEmetteur,typeTransaction,coupon, lot, numero,commentaire)
	  VALUES ('".$typePaiement."','".$montant."','".$beneficiare."','".$nomEmetteur."','".$prenomEmetteur."','".$telephoneEmetteur."','".$typeTransaction."','".$coupon."','".$lot."','".$numero."','".$commentaire."')";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $idModele = $conn->insert_id;
	  $this->setId($idModele);
	  $db->close();
	 }

   public function getCompta(){
     $query = "SELECT * FROM caisse";
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
     $res=mysqli_query($conn,$query);
     $i=0;
     $paiements = array();
     while($row = mysqli_fetch_array($res)){
     $i++;
     $paiement = new Caisse((Int)$row['idPaiementPrimaire'], (String)$row['typePaiement'], (Int)$row['montant'], (String)$row['beneficiaire'], (String)$row['nomEmetteur'], (String)$row['prenomEmetteur'], (String)$row['telephoneEmetteur'], (String)$row['typeTransaction'], (Int)$row['coupon'], (Int)$row['lot'], (timestamp)$row['date'], (String)$row['numero'], (text)$row['commentaire']);
     array_push($paiements, $paiement);
     }
     $db->close();
     return $paiements;
    }
}

?>
