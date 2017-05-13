<?php
    require_once('../model/caisse.php');
    $resultat = Caisse::getLastFond();
    echo json_encode($resultat);
?>
