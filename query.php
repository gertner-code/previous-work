<?php
session_start();
?>

<?php

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

header ("Location: home.php");

}
?>	
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" /></head>
<body><div id="main">
<?php
	require_once("dbstart.php"); 
	
	$firstname= $_POST['firstname'];
	$lastname= $_POST['lastname'];
	$email= $_POST['email'];


	$sql="SELECT rentalId, customerId, firstname, lastname , email, startdate, enddate, cost
			FROM display WHERE firstname= '$firstname' AND lastname= '$lastname' AND email = '$email'
			ORDER BY startdate;";

	$result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
	
	if (mysqli_num_rows($result) > 0) {
		
		while ($row = mysqli_fetch_assoc($result))
		{ 
		
		$customerId= $row['customerId'];
		}
		mysqli_free_result($result);
		
		$result=mysqli_query($conn, "SELECT SUM(cost)AS total FROM display WHERE firstname= '$firstname' AND lastname= '$lastname' AND email = '$email'" );
		while ($row = mysqli_fetch_assoc($result))
		{ 
		
		$total= $row['total'];
		}
		
		
		echo "<p> </p>"	;
		echo "<p>";
		echo $firstname;
		echo " ";
		echo $lastname;
		echo "'s Rentals</p>";
		echo "<p>Total Spent: "; echo round($total,2); echo "</p>";
		echo "<p>To edit this customers address information or company Click ";
		do{
			$i=2;
		echo "<a href='customer_edit.php?id="; echo $customerId; echo"'>Here</a></p>";
		echo "<p>To delete this customer Click <a href='delete.php?type=1&id=";  
		echo $customerId; echo "'>Here</a></p>";
		}while($i<1);
		
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		echo("<table border=1 class='tableing'>");
		echo("<tr><th>Start Date</th><th>End date</th> <th>Cost</th><th>Edit Rental Data</th><th>Delete Rental</th></tr>");
		while($row = mysqli_fetch_array($result)) {

			echo("<tr>");

			echo 
				"<td>" . date("m/d/Y", strtotime($row['startdate'])) . "</td>"
				."<td>" . date("m/d/Y", strtotime($row['enddate'])) . "</td>"
				."<td>" .$row['cost'] . "</td>"
				."<td><a href='rental_edit.php?id=" . $row['rentalId'] . "'>Edit Rentals</a></td>"
				."<td><a href='delete.php?type=2&id=" . $row['rentalId'] . "'>Delete Rental</a></td>";

			echo "</tr>";
		
		}
		echo "</table>";
		
	}	
	else {
		echo "0 results";
	}

mysqli_close($conn);
?>
</div></body>
</html>