<?php

session_start();?>


<?php
if (!(isset($_SESSION['login']) or $_SESSION['login'] != '1')) {

header ("Location: home.php");

}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" /></head>
<body><div id="main">
<a href="employee.php">home</a>

<h2>Rentals for the next <?php echo $_GET['ranged']; ?> </h2>

<?php
require_once("dbstart.php");		


	$ranged= $_GET['ranged'];
	
	date_default_timezone_set('America/New_York');
	$current_date= date('Y-m-d');
	$date_range= date('Y-m-d', strtotime($current_date. "+ {$ranged} days"));
	
	$sql="SELECT firstname, lastname , email, startdate, enddate, cost
			FROM display WHERE startdate <= '$date_range'
			AND enddate >= '$current_date' ORDER BY startdate;";

	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
	
	if (mysqli_num_rows($result) > 0) {
	echo("<table border=1 class='tableing'>");
	echo("<tr><th>Start Date</th><th>End date</th><th>Email</th><th>First Name</th><th>Last Name</th>
	<th>Cost</th></tr>");
		while($row = mysqli_fetch_assoc($result)) {
			echo("<tr>");

			echo "<td>" . date("m/d/Y", strtotime($row['startdate'])) . "</td>"
				."<td>" . date("m/d/Y", strtotime($row['enddate'])) . "</td>"
				."<td>" . $row['email'] . "</td>"
				."<td>" . $row['firstname'] . "</td>"
				."<td>" . $row['lastname'] . "</td>"
				. "<td>" .$row['cost'] . "</td>";


echo "</tr>";
		}
		echo "</table>";
	}	
	else {
		echo "0 results";
	}




?>
</div></body>
</html>	