<?php
if(!$_SESSION['eao']){
	$_SESSION['error'] = "Please login to access page";
	header("location: index.php");
	die();
}
?>