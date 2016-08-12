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
<a href= "employee.php">Menu</a>
<br/>

<h2>COMPANIES:</h2>

<?php
	
	$sqlc="SELECT DISTINCT(company) FROM customer WHERE company IS NOT NULL ORDER BY company;";
	$result=mysqli_query($conn, $sqlc);
	
	while($holding=mysqli_fetch_array($result)){
			
			$counts=mysqli_real_escape_string($conn, $holding['company']);
		
			echo"<h1>"; echo stripslashes($counts); echo"</h1>";
			$sql="SELECT customer.firstname, customer.lastname, customer.email, rental.startdate,rental.enddate, rental.cost 
			FROM customer JOIN rental ON customer.customerId =rental.customerId WHERE company = '$counts' ORDER BY lastname;";

			$answer = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
			
			if (mysqli_num_rows($answer) > 0) {

			echo"<p>";
			echo("<table border=1 class='tableing'>");
			echo("<tr><th>Start Date</th><th>End date</th><th>Email</th><th>First Name</th><th>Last Name</th>
			<th>Cost</th></tr>");
				while($row = mysqli_fetch_assoc($answer)) {
					echo("<tr>");

					echo 
						"<td>" . $row['lastname'] . "</td>"
						."<td>" . $row['firstname'] . "</td>"				
						."<td>" . $row['email'] . "</td>"
						."<td>" . date("m/d/Y", strtotime($row['startdate'])) . "</td>"
						."<td>" . date("m/d/Y", strtotime($row['enddate'])) . "</td>" 
						."<td>" .$row['cost'] . "</td>";


				echo "</tr>";
				}
				echo "</table>";
				echo"</p>";
			}	
			else {error_log("error!", 0);
				echo "0 results";
			}

		}
?>


</div>
</body>
</html>