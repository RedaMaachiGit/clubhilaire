<?php
    require_once('../model/db.php');
    $searchTerm = $_GET['term'];
    $query = "SELECT * FROM marque WHERE libelle LIKE '%".$searchTerm."%'";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
    $res=mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($res)){
      $data[] = $row['libelle'];
      //
      // $groups[$i]["value"]= $i;
      // $groups[$i]["text"]= $row['libelle'];
      // $i++;
    }
    echo json_encode($data);
?>
