<?php
require_once('../model/article.php');

$primaryKey = $_POST['pk'];
if(isset($_POST['name'])){
	$someString = $_POST['name'];
	$newString = preg_replace("/\d+$/","",$someString);
	$columnName = $newString;
	$newValue = $_POST['value'];
	if (empty($newValue)) {
		header('HTTP/1.0 400 Bad Request', true, 400);
    echo "This field is required!";
	} else {
		// header('HTTP/1.0 400 Bad Request', true, 400);
		// print_r($_POST);
    // echo "This field is required!";
		Article::changeColumnValue($columnName, $newValue, $primaryKey);
	}
} else {
	header('HTTP/1.0 400 Bad Request', true, 400);
	echo "This field is required!";
}
?>
