<?php

//Cette classe représente les lot des articles vendus par l'ecole saint Hilare
require_once('db.php');
require_once('vendeur.php');
require_once('acheteur.php');


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
  private $_numPreInscription;



/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////CONSTRUCTEUR////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	 public function __construct($numeroCoupon, $numeroLotVendeur, $prix, $vendeur){
		$this->setCoupon($numeroCoupon);
		$this->setNumeroLotVendeur($numeroLotVendeur);
		$this->setPrix($prix);
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
	 public function getStatut(){
		return $this->_status;
	  }

	// Setter ID
	 public function setStatut($status){
		$this->_status = $status;
	 }

	// Setter numPre
	public function setNumPre($numPre){
		$this->_numPreInscription = $numPre;
	}

	//Getter numPre
	public function getNumPre($numPre){
		return $this->_numPreInscription;
	}

	//Getter numeroCoupon
	 public static function getCouponNoIncrById($id){
     $queryCoupon = "SELECT numeroCoupon FROM lot WHERE idLot=".$id;
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
     $res = $conn->query($queryCoupon) or die(mysqli_error($conn));
     $row = $res->fetch_row();
     $row_cnt = $res->num_rows;
     if($row_cnt != 0){
       return $row[0];
     }
	  }

    public function getCouponIncr(){
      $query1 = "SELECT current FROM coupons WHERE 1";
      $query2 = "UPDATE `coupons` SET `current`=`current`+1 WHERE 1";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res = $conn->query($query1) or die(mysqli_error($conn));
      $row = $res->fetch_row();
      $this->setCoupon($row[0]);
      $res1 = $conn->query($query2) or die(mysqli_error($conn));
      $db->close();
      //$row = $res->fetch_row();
      return $row[0];
 	  }

    public static function getCouponIncrStatic(){
      $query1 = "SELECT current FROM coupons WHERE 1";
      $query2 = "UPDATE `coupons` SET `current`=`current`+1 WHERE 1";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res = $conn->query($query1) or die(mysqli_error($conn));
      $row = $res->fetch_row();
      $this->setCoupon($row[0]);
      $res1 = $conn->query($query2) or die(mysqli_error($conn));
      $db->close();
      //$row = $res->fetch_row();
      return $row[0];
 	  }

    public static function ficheImprime($idLot){
      $query1 = "SELECT fiche FROM lot WHERE idLot=".$idLot;
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res = $conn->query($query1) or die(mysqli_error($conn));
      $row = $res->fetch_row();
      $db->close();
      if(strcmp($row[0],"OUI")){
        return true;
      } else {
        return false;
      }
 	  }

    public static function afficheImprime($idLot){
      $query1 = "SELECT affiche FROM lot WHERE idLot=".$idLot;
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res = $conn->query($query1) or die(mysqli_error($conn));
      $row = $res->fetch_row();
      $db->close();
      if(strcmp($row[0],"OUI")){
        return true;
      } else {
        return false;
      }
 	  }
    //Getter numeroCoupon
   public function getCouponNoIncr(){
     return $this->_numeroCoupon;
    }

	//Setter coupon
	 public function setCoupon($coupon){
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
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $coupon = "-1";
	  $numeroLotVendeur = $conn->real_escape_string($this->getNumeroLotVendeur());
	  $prix = $conn->real_escape_string($this->getPrix());
	  $status = $conn->real_escape_string($this->getStatut());
	  $acheteur = $conn->real_escape_string($this->getAcheteur());
	  $vendeur = $this->getVendeur();
	  $conn->query("SET NAMES UTF8");
	  $idA=null;
	  $idV=null;
	  if($vendeur!=null){
		  $idV=$vendeur->getId();

	  }
	  if($acheteur!=null){
	    $idA=$acheteur->getId();
		if($prix != NULL){
		$query = "INSERT INTO lot (numeroCoupon, numeroLotVendeur, prixVente, statut, idAcheteur, idVendeur)
		VALUES ('".$coupon."','".$numeroLotVendeur."','".$prix."','".$status."','".$idA."','".$idV."')";
		}else{
		$query = "INSERT INTO lot (numeroCoupon, numeroLotVendeur, statut, idAcheteur, idVendeur)
		VALUES ('".$coupon."','".$numeroLotVendeur."','".$status."','".$idA."','".$idV."')";
		}
	  }
	  else{
		if($prix != NULL){
		$query = "INSERT INTO lot (numeroCoupon, numeroLotVendeur, prixVente, statut, idVendeur)
		VALUES ('".$coupon."','".$numeroLotVendeur."','".$prix."','".$status."','".$idV."')";
		}else{
		$query = "INSERT INTO lot (numeroCoupon, numeroLotVendeur, statut, idVendeur)
		VALUES ('".$coupon."','".$numeroLotVendeur."','".$status."','".$idV."')";
		}

	  }
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $idLot = $conn->insert_id;
	  $this->setId($idLot);
	  $db->close();
	 }


	 public function savePreInscription(){
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $coupon = -1;
	  $numeroLotVendeur = $conn->real_escape_string($this->getNumeroLotVendeur());
	  $prix = $conn->real_escape_string($this->getPrix());
	  $status = $conn->real_escape_string($this->getStatut());
	  $acheteur = $conn->real_escape_string($this->getAcheteur());
	  $vendeur = $this->getVendeur();
	  $idA=null;
	  $idV=null;
	  if($vendeur!=null){
		  $idV=$vendeur->getId();

	  }
	  if($acheteur!=null){
	    $idA=$acheteur->getId();
		if($prix != NULL){
		$query = "INSERT INTO lot (numeroCoupon, numeroLotVendeur, prixVente, statut, idAcheteur, idVendeur)
		VALUES ('".$coupon."','".$numeroLotVendeur."','".$prix."','".$status."','".$idA."','".$idV."')";
		}else{
		$query = "INSERT INTO lot (numeroCoupon, numeroLotVendeur, statut, idAcheteur, idVendeur)
		VALUES ('".$coupon."','".$numeroLotVendeur."','".$status."','".$idA."','".$idV."')";
		}
	  }
	  else{
		if($prix != NULL){
		$query = "INSERT INTO lot (numeroCoupon, numeroLotVendeur, prixVente, statut, idVendeur)
		VALUES ('".$coupon."','".$numeroLotVendeur."','".$prix."','".$status."','".$idV."')";
		}else{
		$query = "INSERT INTO lot (numeroCoupon, numeroLotVendeur, statut, idVendeur)
		VALUES ('".$coupon."','".$numeroLotVendeur."','".$status."','".$idV."')";
		}

	  }
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
		$query = "DELETE FROM lot WHERE idLot=".$id;
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
	}

  public function getPrixMoinsMarge() {
		$price = $this->getPrix();
		$query = "SELECT * FROM parametres";
		$db = new DB();
		$db->connect();
		$conn = $db->getConnectDb();
		$res = $conn->query($query) or die(mysqli_error($conn));
		$db->close();
    $row = $res->fetch_row();
    $marge = (String)$row[1];
    $newprice = round($price * ((100-$marge) / 100));
    return $newprice;
	}

		/*
		public Static function getLotById($id) -> get en base de données l'instance ayant l'id $id
		Input : $id
	    Output : le vendeur lot l'id $id
	*/

	public static function getLotById($id){
	  $query = "SELECT * FROM lot WHERE idLot=".$id;
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
	  $lot->setStatut((String)$row[4]);
	  $lot->setAcheteur($acheteur);
	  return $lot;
	}

	public static function getLotByCoupon($coupon){
	  $query = "SELECT * FROM lot WHERE numeroCoupon='$coupon'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  if(!empty($row)){
		  $vendeur = Vendeur::getVendeurById((int)$row[6]);
		  $acheteur = Acheteur::getAcheteurById((int)$row[5]);
		  $lot = new Lot((String)$row[1],(String)$row[2],(int)$row[3],$vendeur);
		  $lot->setId((int)$row[0]);
		  $lot->setStatut((String)$row[4]);
		  $lot->setAcheteur($acheteur);
		  return $lot;
	   }else{
		   return null;
	   }
	 }

	 public static function getLotByNumPre($numPre){
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $numPreInscription = $conn->real_escape_string($numPre);
	  $query = "SELECT * FROM lot WHERE numeroPreInscription='$numPreInscription'";
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  if(!empty($row)){
		  $vendeur = Vendeur::getVendeurById((int)$row[6]);
		  $acheteur = Acheteur::getAcheteurById((int)$row[5]);
		  $lot = new Lot((String)$row[1],(String)$row[2],(int)$row[3],$vendeur);
		  $lot->setId((int)$row[0]);
		  $lot->setStatut((String)$row[4]);
		  $lot->setAcheteur($acheteur);
		  $lot->setNumPre($numPre);
		  return $lot;
	  }else{
		  return null;
	  }
	 }

   public static function getLotByNumPreEnPreparation($numPre){
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $numPreInscription = $conn->real_escape_string($numPre);
	  $query = "SELECT * FROM lot WHERE numeroPreInscription='$numPreInscription' AND statut=\"En preparation\"";
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $row = $res->fetch_row();
	  if(!empty($row)){
		  $vendeur = Vendeur::getVendeurById((int)$row[6]);
		  $acheteur = Acheteur::getAcheteurById((int)$row[5]);
		  $lot = new Lot((String)$row[1],(String)$row[2],(int)$row[3],$vendeur);
		  $lot->setId((int)$row[0]);
		  $lot->setStatut((String)$row[4]);
		  $lot->setAcheteur($acheteur);
		  $lot->setNumPre($numPre);
		  return $lot;
	  }else{
		  return null;
	  }
	 }


	 public static function deleteLotById($idLot){
	  $query = "DELETE FROM lot WHERE idLot=".$idLot;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }

	 public static function deleteLotByIdVendeur($idVendeur){
	  $query = "DELETE FROM lot WHERE idVendeur=".$idVendeur;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }

	public function getLotByStatus($status){
	  $query = "SELECT * FROM lot WHERE statut=" . $status;
    $db = new DB();
    $db->connect();
    $conn = $db->getConnectDb();
    $res=mysqli_query($conn,$query);
    $lots = array();
    $i=0;
    while($row = mysqli_fetch_array($res)){
        $i++;
        $vendeur = Vendeur::getVendeurById((int)$row['idVendeur']);
        $acheteur = Acheteur::getAcheteurById((int)$row['idAcheteur']);
        $lot = new Lot((String)$row['numeroCoupon'],(String)$row['numeroLotVendeur'],(int)$row['prixVente'],$vendeur);
        $lot->setId((int)$row['idLot']);
        $lot->setStatut((String)$row['statut']);
        $lot->setAcheteur($acheteur);
        array_push($lots, $lot);
    }
    $db->close();
    return $lots;
	 }

   public static function getAllLot(){
      $query = "SELECT * FROM lot WHERE statut<>\"Non valide\"";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res=mysqli_query($conn,$query);
      $lots = array();
      $i=0;
      while($row = mysqli_fetch_array($res)){
          $i++;
          $vendeur = Vendeur::getVendeurById((int)$row['idVendeur']);
          $acheteur = Acheteur::getAcheteurById((int)$row['idAcheteur']);
          $lot = new Lot((String)$row['numeroCoupon'],(String)$row['numeroLotVendeur'],(int)$row['prixVente'],$vendeur);
          $lot->setId((int)$row['idLot']);
          $lot->setStatut((String)$row['statut']);
          $lot->setAcheteur($acheteur);
          array_push($lots, $lot);
      }
      $db->close();
      return $lots;
   }

   public function getLotEnVente(){
     $query = "SELECT * FROM lot WHERE statut='En vente'";
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
    //  $resT = $conn->query($query) or die(mysqli_error($conn));
    //  $rowT = $res->fetch_row();
     $res=mysqli_query($conn,$query);
     $i=0;
     $lots = array();
     while($row = mysqli_fetch_array($res)){
     $i++;
     $vendeur = Vendeur::getVendeurById((int)$row['idVendeur']);
     $acheteur = Acheteur::getAcheteurById((int)$row['idAcheteur']);
     $lot = new Lot((String)$row['numeroCoupon'],(String)$row['numeroLotVendeur'],(int)$row['prixVente'],$vendeur);
     $lot->setId((int)$row['idLot']);
     $lot->setStatut((String)$row['statut']);
     $lot->setAcheteur($acheteur);
     array_push($lots, $lot);
     }
     $db->close();
     return $lots;
    }

   public static function getLotEnAttenteImpressionStatic(){
     $query = "SELECT * FROM lot WHERE statut='En attente impression'";
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
    //  $resT = $conn->query($query) or die(mysqli_error($conn));
    //  $rowT = $res->fetch_row();
     $res=mysqli_query($conn,$query);
     $i=0;
     $lots = array();
     while($row = mysqli_fetch_array($res)){
     $i++;
     $vendeur = Vendeur::getVendeurById((int)$row['idVendeur']);
     $acheteur = Acheteur::getAcheteurById((int)$row['idAcheteur']);
     $lot = new Lot((String)$row['numeroCoupon'],(String)$row['numeroLotVendeur'],(int)$row['prixVente'],$vendeur);
     $lot->setId((int)$row['idLot']);
     $lot->setStatut((String)$row['statut']);
     $lot->setAcheteur($acheteur);
     array_push($lots, $lot);
     }
     $db->close();
     return $lots;
    }

   public static function getLotEnVenteStatic(){
     $query = "SELECT * FROM lot WHERE statut='En vente'";
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
    //  $resT = $conn->query($query) or die(mysqli_error($conn));
    //  $rowT = $res->fetch_row();
     $res=mysqli_query($conn,$query);
     $i=0;
     $lots = array();
     while($row = mysqli_fetch_array($res)){
     $i++;
     $vendeur = Vendeur::getVendeurById((int)$row['idVendeur']);
     $acheteur = Acheteur::getAcheteurById((int)$row['idAcheteur']);
     $lot = new Lot((String)$row['numeroCoupon'],(String)$row['numeroLotVendeur'],(int)$row['prixVente'],$vendeur);
     $lot->setId((int)$row['idLot']);
     $lot->setStatut((String)$row['statut']);
     $lot->setAcheteur($acheteur);
     array_push($lots, $lot);
     }
     $db->close();
     return $lots;
    }

	 public Static function getLotByVendeur($idVendeur){
	  $query = "SELECT * FROM lot WHERE idVendeur=".$idVendeur;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $lots = array();
	  while($row = $res->fetch_row()){
  		$vendeur = Vendeur::getVendeurById((int)$row[6]);
  		$acheteur = Acheteur::getAcheteurById((int)$row[5]);
  		$lot = new Lot((String)$row[1],(String)$row[2],(int)$row[3],$vendeur);
  		$lot->setId((int)$row[0]);
  		$lot->setStatut((String)$row[4]);
  		$lot->setAcheteur($acheteur);
  		array_push($lots,$lot);
	  }
	  return $lots;
	}

  public static function lotPossedeProduits($idLot){
    $query = "SELECT * FROM article WHERE idLot='$idLot'";
    $db = new DB();
    $db->connect();
    $conn = $db->getConnectDb();
    $res = $conn->query($query) or die(mysqli_error($conn));
    $db->close();
    $i = 0;
    while($row = $res->fetch_row()) {
      if($i==1){
        return true;
      }
      $type = (int)$row[1];
      $id = (String)$row[0];
      $pTVMinimum = (String)$row[2];
      $PTVMaximum = (String)$row[3];
      $taille = (String)$row[4];
      $annee = (int)$row[5];
      $surfaceVoile = (String)$row[6];
      $couleurVoile = (String)$row[7];
      $heureVolesVoile = (String)$row[8];
      $certificatRevisionVoile = (String)$row[9];
      $typeProtectionSelette = (String)$row[10];
      $typeAccessoire = (String)$row[11];
      $idMarqueIndex = (int)$row[12];
      $idModele = (int)$row[13];
      $homologation = (String)$row[15];
      $commentaire = (String)$row[16];
      if($type != 0 || $pTVMinimum != "" || $PTVMaximum != "" || $taille != "" || $annee != 0 || $surfaceVoile != ""
          || $couleurVoile !="" || $heureVolesVoile !="" || $certificatRevisionVoile !="" || $typeProtectionSelette !=""
          || $typeAccessoire !="" || $idMarqueIndex != 0 || $idModele != 0
          || $homologation != "EN A / DHV LTF-1" || $commentaire !="") {
            return true;
          }
      $i++;
    }
    return false;
  }

  public static function veriferPayerFraisDepot($idLot){
    $statut = "En vente";
    $query = "SELECT * FROM lot WHERE idLot=".$idLot." AND statut !='$statut'";
    $db = new DB();
    $db->connect();
    $conn = $db->getConnectDb();
    $res = $conn->query($query) or die(mysqli_error($conn));
    $db->close();
    $row = $res->fetch_row();
    if(empty($row)){
    	return false;
    }else{
    	return true;
    }
  }

	 public static function getLotEnPreparationByVendeur($idVendeur){
    $statut2 = "En preparation";
	  $query = "SELECT * FROM lot WHERE idVendeur='$idVendeur' AND statut ='$statut2'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  $lots = Array();
	  while($row = $res->fetch_row())
	  {
  		$vendeur = Vendeur::getVendeurById((int)$row[6]);
  		$acheteur = Acheteur::getAcheteurById((int)$row[5]);
  		$lot = new Lot((String)$row[1],(String)$row[2],(int)$row[3],$vendeur);
  		$lot->setId((int)$row[0]);
  		$lot->setStatut((String)$row[4]);
  		$lot->setAcheteur($acheteur);
  		array_push($lots,$lot);
	  }
	  return $lots;
	 }

	 public function updatePrix($prix){
	  $id = $this->getId();
	  $query = "UPDATE lot SET prixVente ='$prix' WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setPrix($prix);
	  $db->close();
	 }


   public static function updateFicheAffiche($idLot, $fiche, $affiche){
     Lot::updateFiche($idLot, $fiche);
     Lot::updateAffiche($idLot, $affiche);
     return;
   }

   public static function updateFiche($idLot, $fiche){
    $query = "UPDATE lot SET fiche ='$fiche' WHERE idLot=".$idLot;
	  $db = new DB();
	  $db->connect();
    $conn = $db->getConnectDb();
    $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
   public static function updateAffiche($idLot, $affiche){
    $query1 = "UPDATE lot SET affiche ='$affiche' WHERE idLot=".$idLot;
	  $db = new DB();
	  $db->connect();
    $conn = $db->getConnectDb();
    $res1 = $conn->query($query1) or die(mysqli_error($conn));
	  $db->close();
	 }

	public function updateStatut($statut){
	  $id = $this->getId();
    $query = "UPDATE lot SET statut ='$statut' WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setStatut($statut);
	  $db->close();
	 }

	public function updateCoupon($numeroCoupon){
	  $id = $this->getId();
	  $query = "UPDATE lot SET numeroCoupon ='$numeroCoupon' WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }

	 public function updateNumeroLotVendeur($numeroLotVendeur){
	  $id = $this->getId();
	  $query = "UPDATE lot SET numeroLotVendeur ='$numeroLotVendeur' WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setNumeroLotVendeur($numeroLotVendeur);
	  $db->close();
	 }

	 public function updateNumPreInscription($numPre){
	  $id = $this->getId();
	  $query = "UPDATE lot SET numeroPreInscription ='$numPre' WHERE idLot=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $this->setNumPre($numPre);
	  $db->close();
	 }

	 public static function lotExistByNumPre($numPre){
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $numPreInscription	 = $conn->real_escape_string($numPre);
	  $query = "SELECT * FROM lot WHERE numeroPreInscription='$numPreInscription'";
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	  if($res->num_rows == 0 ){
		  return false;
	  }else{
		  return true;
	  }
	 }

   public static function sortArrayByKey(&$array,$string = false,$asc = true){
       if($string){
           usort($array,function ($a, $b) use(&$key,&$asc)
           {
               if($asc)    return strcmp(strtolower($a->getLibelleTypeArticle()), strtolower($b->getLibelleTypeArticle()));
               else        return strcmp(strtolower($b->getLibelleTypeArticle()), strtolower($a->getLibelleTypeArticle()));
           });
       }else{
           usort($array,function ($a, $b) use(&$key,&$asc)
           {
               if($a[$key] == $b[$key]){return 0;}
               if($asc) return ($a->getLibelleTypeArticle() < $b->getLibelleTypeArticle()) ? -1 : 1;
               else     return ($a->getLibelleTypeArticle() > $b->getLibelleTypeArticle()) ? -1 : 1;

           });
       }
   }

}
?>
