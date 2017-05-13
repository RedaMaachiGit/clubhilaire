<?php include('../model/db.php');

	$id = $_POST['identifiant'];

	$query = "SELECT statut FROM lot WHERE numeroCoupon='$id'";
	$db = new DB();
	$db->connect();
	$conn = $db->getConnectDb();
	$res=mysqli_query($conn,$query);
	$row = mysqli_fetch_array($res);

	if($row[0] === "En vente"){
		echo 'Cliquez sur Vendre pour vendre le lot';
	} else if(!isset($row[0]) || empty($row[0]) || $row[0] === ""){
		echo 'Êtes-vous sûr que ce lot existe?';
	} else {
		echo 'Ce lot ne peux pas être vendu. Son statut: '.$row[0];
	}


?>
