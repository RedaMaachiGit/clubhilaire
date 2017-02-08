<?php include('../model/db.php');

	$id = $_POST['identifiant'];

	$query = "SELECT statut FROM lot WHERE numeroCoupon='$id'";
	$db = new DB();
	$db->connect();
	$conn = $db->getConnectDb();
	$res=mysqli_query($conn,$query);
	$row = mysqli_fetch_array($res);

	if($row[0] === "En vente" || $row[0] === "Restitue" || $row[0] === "Prepaye" || $row[0] === "Paye remis" || $row[0] === "En attente impression" || $row[0] === "Vendu"){
		echo 'Ce lot ne peux pas être modifié son statut: '.$row[0];
	} else if(!isset($row[0]) || empty($row[0]) || $row[0] === ""){
		echo 'Êtes-vous sûr que ce lot existe?';
	} else {
		echo 'Cliquez sur MODIFIER pour modifier le lot';
	}


?>
