<?php
session_start();
?>

<?php

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

header ("Location: home.php");

}
?>	

<http>

<head>
<title>All rentals</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<?php require_once("dbstart.php"); ?>
</head>


<body>

<div id="main">
<a href= "home.php">Home</a>
<br/>
<h2>RENTALS:</h2>

<?php

	$sql="SELECT * FROM display  ORDER BY startdate;";

	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
	
	if (mysqli_num_rows($result) > 0) {
	echo("<table border=1 class='tableing'>");
	echo("<tr><th>Start Date</th><th>End date</th><th>Email</th><th>First Name</th><th>Last Name</th>
	<th>Cost</th></tr>");
		while($row = mysqli_fetch_assoc($result)) {
			echo("<tr>");

			echo 
				"<td>" . $row['firstname'] . "</td>"
				."<td>" . $row['lastname'] . "</td>"
				."<td>" . $row['email'] . "</td>"
				."<td>" . date("m/d/Y", strtotime($row['startdate'])) . "</td>"
				."<td>" . date("m/d/Y", strtotime($row['enddate'])) . "</td>" 
				."<td>" .$row['cost'] . "</td>";


echo "</tr>";
		}
		echo "</table>";
	}	
	else {
		echo "0 results";
	}
?>


</div>
</body>
</html>