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
<h2>CUSTOMERS:</h2>

<?php
	$sql="SELECT * FROM customer ;";
				$result=mysqli_query($conn, $sql);
				echo("<table border=1 class='tableing'>");
				echo("<tr><th>First Name</th><th>Last Name</th><th>Birth date</th><th>Street Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Email</th>
				<th>company</th></tr>");
				while($row = mysqli_fetch_assoc($result)) {
				echo("<tr>");
					echo "<td>" . $row['firstname'] . "</td>"
					."<td>" . $row['lastname'] . "</td>"
					."<td>" .date("m/d/Y", strtotime($row['birthdate'])) . "</td>"
					."<td>" . $row['streetaddress'] . "</td>"
					. "<td>" .$row['city'] . "</td>"
					. "<td>" .$row['state'] . "</td>"
					. "<td>" .$row['zip'] . "</td>"
					."<td>" . $row['email'] . "</td>"
					. "<td>" .$row['company'] . "</td>";
				echo "</tr>";
				}
				echo "</table>";
?>


</div>
</body>
</html>