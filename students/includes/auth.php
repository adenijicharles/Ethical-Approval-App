<?php
if(!$_SESSION['user']){
	$_SESSION['error'] = "Please login to access page";
	header("location: index.php");
	die();
}
?>