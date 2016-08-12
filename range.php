<?php

session_start();


if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

header ("Location: home.php");

}
else{
require_once("dbstart.php");		


	$range=$_GET['range'];







}
?>	