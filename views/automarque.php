<?php
    //database configuration
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbName = "clubhilaire";

    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    //get search term
    $searchTerm = $_GET['term'];

    //get matched data from skills table
    $query = $db->query("SELECT * FROM marque WHERE libelle LIKE '%".$searchTerm."%'");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['libelle'];
    }

    //return json data
    echo json_encode($data);
?>
