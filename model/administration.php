<?php

//Cette classe représente les variable d'administration
require_once('db.php');
require_once('vendeur.php');
require_once('acheteur.php');


class Administration
{



		/*
		public function delete() -> delete en base de données l'instance
		Input : Void
	    Output : Void
	*/

	public function delete() {
		$id = $this->getId();
		$query = "DELETE FROM fraisdepotadmin WHERE idDepotAdmin=".$id;
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

	public Static function addFraisDepot($niveau, $frais){
	  $query = "INSERT INTO fraisdepotadmin (idDepotAdmin,niveauDepotAdmin,fraisDepotAdmin) VALUES ('','".$niveau."','".$frais."')";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }

	public Static function deleteFraisDepotById($id){
	  $query = "DELETE FROM fraisdepotadmin WHERE idDepotAdmin=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }

	public static function getFraisDepotByNiveau($niveau){
	  $query = "SELECT * FROM fraisdepotadmin WHERE niveauDepotAdmin <=".$niveau." ORDER BY fraisDepotAdmin desc";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $row = $res->fetch_row();
	  if (empty($row)) {
		$query = "SELECT * FROM fraisdepotadmin ORDER BY fraisDepotAdmin asc";
		$res = $conn->query($query) or die(mysqli_error($conn));
		$row = $res->fetch_row();
	  }
	  $db->close();
	  return (int)$row[1];
	}

	public Static function updateNiveauFraisDepotById($id,$niveau){
	  $query = "UPDATE fraisdepotadmin SET niveauDepotAdmin ='$niveau' WHERE idDepotAdmin=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }

	public Static function updateFraisDepotById($id,$frais){
	  $query = "UPDATE fraisdepotadmin SET fraisDepotAdmin ='$frais' WHERE idDepotAdmin=".$id;
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $db->close();
	 }
	 public Static function updateMarge($marge){
 	  $query = "UPDATE parametres SET marge ='$marge' WHERE 1";
 	  $db = new DB();
 	  $db->connect();
 	  $conn = $db->getConnectDb();
 	  $res = $conn->query($query) or die(mysqli_error($conn));
 	  $db->close();
 	 }
	 
	 public Static function updatePrix($prix){
	  $id=1;
 	  $query = "UPDATE prix SET prix ='$prix' WHERE idPrix=".$id;
 	  $db = new DB();
 	  $db->connect();
 	  $conn = $db->getConnectDb();
 	  $res = $conn->query($query) or die(mysqli_error($conn));
 	  $db->close();
 	 }
	 
	 public Static function getPrix(){
	  $query = "SELECT * FROM prix";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res=mysqli_query($conn,$query);
	  $row = mysqli_fetch_array($res);
      $db->close();
      return $row[0];
	 }

	 public static function getParams(){
     $query = "SELECT * FROM fraisdepotadmin";
     $db = new DB();
     $db->connect();
     $conn = $db->getConnectDb();
     $res=mysqli_query($conn,$query);
     $i=0;
     $admins = array();
		 $admin = array();
     while($row = mysqli_fetch_array($res)){
     $i++;
		 $admin = array("niveauDepotAdmin" => (int)$row['niveauDepotAdmin'], "fraisDepotAdmin" => (int)$row['fraisDepotAdmin'], "idDepotAdmin" => (int)$row['idDepotAdmin']);
     array_push($admins, $admin);
     }
     $db->close();
     return $admins;
    }
		public static function getMarge(){
      $query = "SELECT * FROM parametres";
      $db = new DB();
      $db->connect();
      $conn = $db->getConnectDb();
      $res=mysqli_query($conn,$query);
      $i=0;
      $admins = array();
 		 	$admin = array();
      while($row = mysqli_fetch_array($res)){
      $i++;
 		 	$admin = array("id" => (int)$row['idParametre'], "marge" => (int)$row['marge']);
      array_push($admins, $admin);
      }
      $db->close();
      return $admins;
    }
}



?>
