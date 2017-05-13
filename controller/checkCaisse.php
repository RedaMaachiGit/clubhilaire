<?php include('../model/db.php');
	$journee = date('d/m/Y');
	$query = "SELECT * FROM caisse WHERE journee='$journee' AND typeTransaction='Ouverture caisse'";
	$db = new DB();
	$db->connect();
	$conn = $db->getConnectDb();
	$res=mysqli_query($conn,$query);
	$row = mysqli_num_rows($res);
	if($row == 0){
		echo "NON";
	} else {
		echo "OUI";
	}
?>
