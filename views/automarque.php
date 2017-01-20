<?php
//Cette classe représente les vendeurs
require_once('db.php');
  $db = new DB();
	  $db->connect();
	  $conn = $db->getConnectDb();
    if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysql_query ("SELECT libelle FROM marque WHERE libelle LIKE '%{$query}%'");
	  $array = array();
    while ($row = mysql_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['marque'],
            'value' => $row['marque'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}
	  $db->close();
?>
