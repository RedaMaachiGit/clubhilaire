<?php

//Cette classe représente les variable d'administration
require_once('db.php');
require_once('Vendeur.php');
require_once('Acheteur.php');


class Administration
{



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

	public static function getFraisDepotByNiveeau($niveau){
	  $query = "SELECT * FROM fraisdepotadmin WHERE niveauDepotAdmin <=".$niveau." ORDER BY fraisDepotAdmin desc";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
	  $res = $conn->query($query) or die(mysqli_error($conn));
	  $row = $res->fetch_row();
	  $db->close();
	  return (int)$row[2];
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
}



?>
