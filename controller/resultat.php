<?php
    require_once('../model/caisse.php');
    // $query = "SELECT * FROM caisse";
	  // $db = new DB();
	  // $db->connect();
	  // $conn = $db->getConnectDb();
    // $res=mysqli_query($conn,$query);
    // $i = 1;
    // $lots = array();
    // $groups = array();
    // $groups[0]["value"]= 0;
    // $groups[0]["text"]= "";
    // while($row = mysqli_fetch_array($res)){
    //   $groups[$i]["value"]= $row['idVendeur'];
    //   $groups[$i]["text"]= $row['mail'];
    //   $i++;
    // }
    $resultat = Caisse::getResultat();
    echo json_encode($resultat);
?>
