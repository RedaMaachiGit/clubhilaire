<?php
    require_once('../model/db.php');
    $searchTerm = $_GET['term'];
    // $query = "SELECT * FROM vendeur WHERE mail LIKE '%".$searchTerm."%'";
    $query = "SELECT * FROM vendeur";
	  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
    $res=mysqli_query($conn,$query);
    $data = array();
    $i=0;
    $initialSuburbsArray = array( );

    while( $row = mysqli_fetch_array( $res ) ) {
        $initialSuburbsArray[] = $row;
    }
    $suburbs = $initialSuburbsArray;
    // Cleaning up the term
    $term = trim(strip_tags($_GET['term']));
    // get match
    $matches = array();
    foreach($suburbs as $suburb){
      if(stripos($suburb['mail'], $term) !== false){
        // Adding the necessary "value" and "label" fields and appending to result set
        $suburb['value'] = $suburb['mail'];
        $suburb['label'] = "{$suburb['mail']}, {$suburb['nom']}, {$suburb['prenom']}, {$suburb['telephone']}, {$suburb['adresse']}";
        $matches[] = $suburb;
      }
    }
    // Truncate, encode and return the results
    $matches = array_slice($matches, 0, 5);
    // print json_encode($matches);
    echo json_encode($matches);
?>
