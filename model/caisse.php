<?php
require_once('db.php');



class Caisse
{
  private $_idPaiement;
  private $_journee;
  private $_fondecaisse;
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

	 public function __construct($journee,$fondecaisse,$typePaiement,$montant,$beneficiare,$nomEmetteur,$prenomEmetteur,$telephoneEmetteur,$typeTransaction,$date,$numero,$commentaire){
    $this->setJournee($journee);
    $this->setFonDeCaisse($fondecaisse);
    $this->setTypePaiement($typePaiement);
		$this->setMontant($montant);
		$this->setNom($nomEmetteur);
		$this->setPrenom($prenomEmetteur);
		$this->settelephoneEmetteur($telephoneEmetteur);
    $this->settypeTransaction($typeTransaction);
    $this->setBeneficiaire($beneficiare);
    $this->setdate($date);
    $this->setNumero($numero);
		$this->setCommentaire($commentaire);
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////GETTER/SETTER///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// Getter ID


  public function getJournee(){
    return $this->_journee;
  }

  public function setJournee($journee){
    return $this->_journee = $journee;
  }
  public function getIdPaiement(){
    return $this->_idPaiement;
  }

  public function setIdPaiement($idPaiement){
    return $this->_idPaiement = $idPaiement;
  }

  public function getFonDeCaisse(){
    return $this->_fondecaisse;
  }

  public function setFonDeCaisse($fondecaisse){
    return $this->_fondecaisse = $fondecaisse;
  }

  public function gettypeTransaction(){
    return $this->_typeTransaction;
  }

  public function settypeTransaction($typeTransaction){
    return $this->_typeTransaction = $typeTransaction;
  }

  public function getcoupon(){
    return $this->_coupon;
  }

  public function setcoupon($coupon){
    return $this->_coupon = $coupon;
  }
  public function getlot(){
    return $this->_lot;
  }

  public function setlot($lot){
    return $this->_lot = $lot;
  }
  public function getBeneficiaire(){
    return $this->_beneficiare;
  }

  public function setBeneficiaire($beneficiare){
    return $this->_beneficiare = $beneficiare;
  }
  public function getdate(){
    return $this->_date;
  }

  public function setdate($date){
    return $this->_date = $date;
  }


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
  return $this->_typePaiement = $typePaiement;
  }

  public function getMontant(){
   return $this->_montant;
  }

  public function setMontant($montant){
  return $this->_montant = $montant;
  }

  public function getNom(){
   return $this->_nomEmetteur;
  }

  public function setNom($nomEmetteur){
  return $this->_nomEmetteur = $nomEmetteur;
  }

  public function getPrenom(){
   return $this->_prenomEmetteur;
  }

  public function setPrenom($prenomEmetteur){
  return $this->_prenomEmetteur = $prenomEmetteur;
  }

  public function gettelephoneEmetteur(){
   return $this->_telephoneEmetteur;
  }

  public function settelephoneEmetteur($telephoneEmetteur){
  return $this->_telephoneEmetteur = $telephoneEmetteur;
  }

  public function getNumero(){
   return $this->_numero;
  }

  public function setNumero($numero){
  return $this->_numero = $numero;
  }

  public function getCommentaire(){
   return $this->_commentaire;
  }

  public function setCommentaire($commentaire){
  return $this->_commentaire = $commentaire;
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
    $journee = $this->getJournee();
    $fondCaisse = $this->getFonDeCaisse();
	  $typePaiement = $this->getTypePaiement();
	  $montant = $this->getMontant();
    $beneficiare = $this->getBeneficiaire();
	  $nomEmetteur = $this->getNom();
	  $prenomEmetteur = $this->getPrenom();
	  $telephoneEmetteur = $this->gettelephoneEmetteur();
	  $numero = $this->getNumero();
	  $commentaire = $this->getCommentaire();
    $typeTransaction = $this->gettypeTransaction();
    $lot = $this->getLot();
    $coupon = $this->getCoupon();
    $db = new DB();
    $db->connect();
    $conn = $db->getConnectDb();
	$conn->query("SET NAMES UTF8");
	  $query = "INSERT INTO caisse (journee,fondCaisse,typePaiement,montant,beneficiaire,nomEmetteur,prenomEmetteur,telephoneEmetteur,typeTransaction, numero,commentaire)
	  VALUES ('".$journee."','".$fondCaisse."','".$typePaiement."','".$montant."','".$beneficiare."','".$nomEmetteur."','".$prenomEmetteur."','".$telephoneEmetteur."','".$typeTransaction."','".$numero."','".$commentaire."')";

    $res = $conn->query($query) or die(mysqli_error($conn));
	  $idCaisse = $conn->insert_id;
	  $this->setId($idCaisse);

    $numeroDeLot = $lot->getId();
    $numeroDeCoupon = $lot->getCouponNoIncr();
    $queryForeign = "INSERT INTO paiementLot (idCaisse,idLot,numCoupon) VALUES ('".$idCaisse."','".$numeroDeLot."','".$numeroDeCoupon."')";
    $resForeign = $conn->query($queryForeign) or die(mysqli_error($conn));

	  $db->close();
	 }

    public static function getOuvertureCaisse($journee){
      $query = "SELECT count(*) FROM caisse WHERE `typeTransaction`=\"Ouverture caisse\" AND journee='$journee'";
      $query1 = "SELECT count(*) FROM caisse WHERE `typeTransaction`=\"Fermeture caisse\" AND journee='$journee'";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res = mysqli_query($conn,$query);
      $res1 = mysqli_query($conn,$query1);
      $lotsString = 0;
      while($row = mysqli_fetch_array($res)){
        $nombreOuverture = (int)$row[0];
      }
      while($row1 = mysqli_fetch_array($res1)){
        $nombreFermeture = (int)$row1[0];
      }
      if($nombreOuverture > $nombreFermeture){
        return 0; // Refuser l'ouverture
      } else {
        return 1; // Accepter
      }
    }

    public static function getFermetureCaisse($journee){
      $query = "SELECT count(*) FROM caisse WHERE `typeTransaction`=\"Ouverture caisse\" AND journee='$journee'";
      $query1 = "SELECT count(*) FROM caisse WHERE `typeTransaction`=\"Fermeture caisse\" AND journee='$journee'";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res = mysqli_query($conn,$query);
      $res1 = mysqli_query($conn,$query1);
      $lotsString = 0;
      while($row = mysqli_fetch_array($res)){
        $nombreOuverture = (int)$row[0];
      }
      while($row1 = mysqli_fetch_array($res1)){
        $nombreFermeture = (int)$row1[0];
      }
      if($nombreOuverture == 0 || $nombreOuverture == $nombreFermeture){
        return 0; // Refuser la fermeture
      } else {
        return 1; // Accepter
      }
    }

    public function ouvrirFermerCaisse(){
      $journee = $this->getJournee();
      $fondCaisse = $this->getFonDeCaisse();
      $typePaiement = $this->getTypePaiement();
      $montant = $this->getMontant();
      $beneficiare = $this->getBeneficiaire();
      $nomEmetteur = $this->getNom();
      $prenomEmetteur = $this->getPrenom();
      $telephoneEmetteur = $this->gettelephoneEmetteur();
      $numero = $this->getNumero();
      $commentaire = $this->getCommentaire();
      $typeTransaction = $this->gettypeTransaction();
      $lot = $this->getLot();
      $coupon = $this->getCoupon();
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
	    $conn->query("SET NAMES UTF8");
      $query = "INSERT INTO caisse (journee,fondCaisse,typePaiement,montant,beneficiaire,nomEmetteur,prenomEmetteur,telephoneEmetteur,typeTransaction, numero,commentaire)
      VALUES ('".$journee."','".$fondCaisse."','".$typePaiement."','".$montant."','".$beneficiare."','".$nomEmetteur."','".$prenomEmetteur."','".$telephoneEmetteur."','".$typeTransaction."','".$numero."','".$commentaire."')";

      $res = $conn->query($query) or die(mysqli_error($conn));
      $idCaisse = $conn->insert_id;
      $this->setId($idCaisse);
      $db->close();
     }

    public static function payerLotMultiple($nombreDeLots, $journee,$fondecaisse,$typePaiement,$montant,$beneficiare,$nomEmetteur,$prenomEmetteur,$telephoneEmetteur,$typeTransaction,$lots,$numero,$commentaire){
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
	  $conn->query("SET NAMES UTF8");
      $query = "INSERT INTO caisse (journee,fondCaisse,typePaiement,montant,beneficiaire,nomEmetteur,prenomEmetteur,telephoneEmetteur,typeTransaction, numero,commentaire)
      VALUES ('".$journee."','".$fondecaisse."','".$typePaiement."','".$montant."','".$beneficiare."','".$nomEmetteur."','".$prenomEmetteur."','".$telephoneEmetteur."','".$typeTransaction."','".$numero."','".$commentaire."')";

      $res = $conn->query($query) or die(mysqli_error($conn));
      $idCaisse = $conn->insert_id;

      for($i=0;$i<$nombreDeLots;$i++){
        $numeroDeLot = $lots[$i]->getId();
        if($lots[$i]->getCouponNoIncr() == -1){
          $numeroDeCoupon = $lots[$i]->getCouponIncr();
        } else {
          $numeroDeCoupon = $lots[$i]->getCouponNoIncr();
        }
        $lots[$i]->updateCoupon($numeroDeCoupon);
        $queryForeign = "INSERT INTO paiementLot (idCaisse,idLot,numCoupon) VALUES ('".$idCaisse."','".$numeroDeLot."','".$numeroDeCoupon."')";
        $resForeign = $conn->query($queryForeign) or die(mysqli_error($conn));
      }
      $db->close();
    }


    public static function getLastOpeartion(){
      $query = "SELECT * FROM caisse ORDER BY idPaiement DESC LIMIT 1";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res=mysqli_query($conn,$query);
      if(!empty($row)){
       $paiement = new Caisse((String)$row['journee'],(int)$row['fondCaisse'],
                             (String)$row['typePaiement'], (int)$row['montant'],
                             (String)$row['beneficiaire'], (String)$row['nomEmetteur'],
                             (String)$row['prenomEmetteur'], (String)$row['telephoneEmetteur'],
                             (String)$row['typeTransaction'], (String)$row['date'], (String)$row['numero'],
                             (String)$row['commentaire']);
       $paiement->setIdPaiement((int)$row['idPaiement']);
  		  return $paiement;
  	  }else{
  		  return null;
  	  }
    }

   public static function getLotPayeString($idCaisse){
      $query = "SELECT * FROM paiementLot WHERE idCaisse=" .$idCaisse;
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res=mysqli_query($conn,$query);
      $lotsString = "";
      while($row = mysqli_fetch_array($res)){
        $lotsString .= (String)$row[3] . "<br>";
      }
      return $lotsString;
   }

   public static function getLastFond(){
     $query = "SELECT * FROM caisse ORDER BY idPaiement DESC LIMIT 1";
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
     $res=mysqli_query($conn,$query);
     $row = $res->fetch_row();
     if(!empty($row)){
      return (int)$row[2];
 	  }else{
 		  return null;
 	  }
   }

   public static function getNumberOfOperations(){
     $query = "SELECT * FROM caisse";
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
     $res=mysqli_query($conn,$query);
     $rowCount = $res->num_rows;
     $db->close();
     return $rowCount;
    }

   public static function getCompta(){
     $query = "SELECT * FROM caisse";
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
     $res=mysqli_query($conn,$query);
     $i=0;
     $paiements = array();
     while($row = mysqli_fetch_array($res)){
     $i++;
    //  print_r($row);
    $paiement = new Caisse((String)$row['journee'],(int)$row['fondCaisse'],
                          (String)$row['typePaiement'], (int)$row['montant'],
                          (String)$row['beneficiaire'], (String)$row['nomEmetteur'],
                          (String)$row['prenomEmetteur'], (String)$row['telephoneEmetteur'],
                          (String)$row['typeTransaction'], (String)$row['date'], (String)$row['numero'],
                          (String)$row['commentaire']);
     $paiement->setIdPaiement((int)$row['idPaiement']);
     array_push($paiements, $paiement);
     }
     $db->close();
     return $paiements;
    }

    public static function getMontantPayeParTypePaiement($typeDePaiement){
      $query = "SELECT * FROM caisse WHERE typePaiement=\"" .$typeDePaiement."\"";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res=mysqli_query($conn,$query);
      $i=0;
      $montantTotal = 0;
      $paiements = array();
      while($row = mysqli_fetch_array($res)){
      $i++;
      $montantTotal = $montantTotal + (int)$row['montant'];
      }
      $db->close();
      return $montantTotal;
    }

    public static function getResultat(){
      $fraisDeDepot = "Paiement de frais de dépôt COLLATE utf8_bin";
      $query = "SELECT * FROM caisse WHERE typeTransaction =\"Paiement de frais de dépôt\" COLLATE utf8_bin";
      $query1 = "SELECT * FROM caisse WHERE typeTransaction = \"Vente de lot\"";
      $query2 = "SELECT * FROM caisse WHERE typeTransaction = \"Ouverture caisse\"";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      // $mysqli->query('SET NAMES utf8');
      $res=mysqli_query($conn,$query);
      $res1=mysqli_query($conn,$query1);
      $res2=mysqli_query($conn,$query2);
      $i=0;
      $j=0;
      $k=0;
      $montantFraisDepot = 0;
      $montantVentes = 0;
      $ouvertures = 0;
      while($row = mysqli_fetch_array($res)){
        $i++;
        $montantFraisDepot = $montantFraisDepot + (int)$row['montant'];
      }
      while($row1 = mysqli_fetch_array($res1)){
        $j++;
        $montantVentes = $montantVentes + (int)$row1['montant'];
      }
      while($row2 = mysqli_fetch_array($res2)){
        $k++;
        $ouvertures = $ouvertures + (int)$row2['montant'];
      }
      $db->close();
      return $montantFraisDepot + 0.1*$montantVentes;
    }

    public static function getNombreLotVendu(){
      $query = "SELECT * FROM lot WHERE statut = \"Vendu\"";
      $query1 = "SELECT DISTINCT(idLot) FROM paiementLot WHERE idLot IN (SELECT idLot FROM lot WHERE statut='Vendu');";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res=mysqli_query($conn,$query);
      $res1=mysqli_query($conn,$query1);
      $rowCount = $res->num_rows;
      $rowCount1 = $res1->num_rows;
      $db->close();
      if($rowCount == $rowCount1){
        return $rowCount;
      } else {
        return "Attention: nbre de lots vendu (".$rowCount.") différent du nbre de paiement enregistrés (".$rowCount1.")";
      }

    }
}

?>
