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
<a href= "employee.php">Menu</a>
<?php



require_once("dbstart.php"); 
	
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$_SESSION['id']= $id;
	}
	else
	{
		$id= $_SESSION['id'];
	}
	if(isset($_GET['type'])){
		$type=$_GET['type'];
		$_SESSION['type']= $type;
	}
	else
	{
		$type= $_SESSION['type'];
	}
		
	if(isset($_POST['delete'])){
		if($type==1){
			$sql="DELETE FROM customer WHERE customerId= '$id';";
			$result=mysqli_query($conn, $sql);
			
		}
		else{
			$sql="DELETE FROM rental WHERE rentalId= '$id';";
			$result=mysqli_query($conn, $sql);
		}
	
	
	
	}
		
		if($type ==1){
				
				$sql="SELECT * FROM customer WHERE customerId = '$id';";
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
			<form action="delete.php" method="post" >
			<input type="submit" value="delete" name="delete"/>
			</form>
<?php			
		}
		else{
				$sql="SELECT * FROM rental WHERE rentalId = '$id';";
				$result=mysqli_query($conn, $sql);
				echo("<table border=1 class='tableing'>");
				echo("<tr><th>Vehicle ID</th><th>Start Date</th><th>End date</th><th>Cost</th></tr>");
				while($row = mysqli_fetch_assoc($result)) {
					echo("<tr>");
						echo "<td>" . $row['vehicleId'] . "</td>"
						."<td>" .date("m/d/Y", strtotime($row['startdate'])) . "</td>"
						."<td>" .date("m/d/Y", strtotime($row['enddate'])) . "</td>"
						."<td>" . $row['cost'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				
			?>
			<form <form action="delete.php" method= "post">
			<input type="submit" value="delete" name="delete"/>
			</form>
	<?php			

			}
	

	
	

?>
</div></body>
</html>
