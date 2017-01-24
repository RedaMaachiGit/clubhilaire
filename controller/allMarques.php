<?php
    require_once('../model/db.php');
    $query = "SELECT * FROM marque";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
    $res=mysqli_query($conn,$query);
    $i = 1;
    $lots = array();
    $groups = array();
    $groups[0]["value"]= 0;
    $groups[0]["text"]= "";
    while($row = mysqli_fetch_array($res)){
      $groups[$i]["value"]= $i;
      $groups[$i]["text"]= $row['libelle'];
      $i++;
    }
    echo json_encode($groups);
?>
