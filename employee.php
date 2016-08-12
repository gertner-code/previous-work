<?php
session_start();
?>

<?php

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

header ("Location: home.php");

}

require_once("dbstart.php");		
?>	

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" /></head>
<body><div id="main">
	<a href="home.php">FRONT PAGE</a>
	<br/>
	<h1>Employee Menu:</h1>
	<p>Here you can easily view all information on all our rentals and customers.</p>
	<p><a href= "new_rent.php">Add a new rental: </a>: For when people come in inperson. </p>
	<p>View All Rentals: <a href="all_rental.php">Click Here.</a>: Here you can view all rental currently in our database.</p>
	<p>View All Customers: <a href="all_customer.php">Click Here.</a>: Here you can view all customer information currently on record</p> 
	<p>View Company tables:<a href="companys.php">Click Here.</a>: View rentals from companies.</p> 
	<p>View the Rentals for the next: <a href= "view_rent.php?ranged=7"> week</a>  / 
	<a href= "view_rent.php?ranged=30">month</a>: probably best to check this often to stay on top of business. </p>
	<!--<p><a href= "change_vehicles.php">Change prices on the vehicles</a>: mostly for sales.</p><br/> -->
	

	<p>To: </p>
	<p>Add Fees/discounts to rental</p>
	<p>Delete customer data</p>
	<p>Delete a rental</p>
	<p>Extend/shorten a Rental</p>
	<p>View customer history</p>
	<p>Enter the following information about the customer.</p>
	<p>(note any request to remove customer information must be complied with.)</p>
	<form action="query.php" method="post">
	<p>First Name:</p>
	<input type= "text" name="firstname" maxlength="20" required>
	<p>Last Name:</p>
	<input type= "text" name="lastname" maxlength="20" required>
	<p>Email:<br/>
	<input type="email" name="email" maxlength="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></p>
	<input type= "submit" name="submit" value="submit">
	
	
</div></body>
</html>
	
	
	







