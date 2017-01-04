<?php

error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('Europe/London');

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>PHPExcel Reader Example #01</title>

</head>
<body>

<h1>PHPExcel Reader Example #01</h1>
<h2>Simple File Reader using PHPExcel_IOFactory::load()</h2>
<?php

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'excel/Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


$inputFileName = 'excel/pre_inscription_ecole/pre_inscription.xls';
echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


echo '<hr />';

$nomEcole= $objPHPExcel->getActiveSheet()->getCell('B2');
$telephone = $objPHPExcel->getActiveSheet()->getCell('B3');
$email = $objPHPExcel->getActiveSheet()->getCell('B4');
$contactEcole = $objPHPExcel->getActiveSheet()->getCell('B5');

$ligne = 13;
$colonne = "B";
while ($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne)!="") {
	$prix = $objPHPExcel->getActiveSheet()->getCell($colonne.$ligne);
	$colonne++;
	while($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne)!=""){
		$colonne++;
		$typeMatos = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$marque = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$modele = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$categorie = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$annee = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$couleur = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$taille = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$ptvmin = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$ptvmax = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$homologation = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$certificat = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$nbHeureVole = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
		$commentaire = htmlspecialchars($objPHPExcel->getActiveSheet()->getCell($colonne.$ligne));
		$colonne++;
	}
	$colonne = "B";
	$ligne++;
}
?>
<body>
</html>