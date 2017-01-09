<?php
	echo("Debut: " . $_POST['inputDebut'] . "<br />\n");
	echo("Fin: " . $_POST['inputFin'] . "<br />\n");
	echo("Nombres de coupons: " . bcsub($_POST['inputFin'], $_POST['inputDebut']) . "<br />\n");
?>
