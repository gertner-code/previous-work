<?php
	session_start();

	$_SESSION['firstname'] = $_REQUEST['firstname'];
	$_SESSION['lastname'] = $_REQUEST['lastname'];
	$_SESSION['birthdate'] = $_REQUEST['birthdate'];
	$_SESSION['streetaddress'] = $_REQUEST['streetaddress'];
	$_SESSION['city'] = $_REQUEST['city'];
	$_SESSION['state'] = $_REQUEST['state'];
	$_SESSION['zip'] = $_REQUEST['zip'];
	$_SESSION['email'] = $_REQUEST['email'];
	if($_REQUEST['company'] != null){
		$_SESSION['company'] = $_REQUEST['company'];
		}
	else{
		$_SESSION['company']= null;
	}
	
	header ("Location: confirm.php");


?>