<?php
if(!$_SESSION['staff']){
	$_SESSION['error'] = "Please login to access page";
	header("location: index.php");
	die();
}
?>