<?php session_start(); ?>
<?php require_once("dbstart.php"); ?>



<html lang="en">
<head>
    <title>Confirm Rental</title>
<link rel="stylesheet" type="text/css" href="style.css" /></head>
<body><div id="main">
<a href= "home.php">Home</a>
<?php 

	$size = $_SESSION['size'];
	$startdate = $_SESSION['startdate'];
	$enddate = $_SESSION['enddate'];
	$vehicleId = $_SESSION['vehicleId'];
	$cost = $_SESSION['cost'];
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];
	$birthdate = $_SESSION['birthdate'];
	$streetaddress = $_SESSION['streetaddress'];
	$city = $_SESSION['city'];
	$state = $_SESSION['state'];
	$zip = $_SESSION['zip'];
	$email = $_SESSION['email'];
	$company = $_SESSION['company'];
	
	$startout = date("m/d/Y", strtotime($startdate));
	$endout = date("m/d/Y", strtotime($enddate));
	
	//duplicate check
	
	$sql="SELECT customerId, firstname, lastname, email FROM customer WHERE firstname = '". $firstname."' AND lastname = '". $lastname."' AND email = '". $email."' ";
	
	//insert customer info
	$stmt1 = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt1, "INSERT INTO customer (firstname, lastname, birthdate, streetaddress, city, state, zip, email, company) VALUES (?,?,?,?,?,?,?,?,?)");
	mysqli_stmt_bind_param($stmt1, 'sssssssss', $firstname, $lastname, $birthdate, $streetaddress, $city, $state, $zip, $email, $company);
	//insert rental info
	$stmt2 = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt2, "INSERT INTO rental (customerId, vehicleId, startdate, enddate, cost) VALUES (?,?,?,?,?)");
	mysqli_stmt_bind_param($stmt2, 'iisss', $customerId, $vehicleId, $startdate, $enddate, $cost);
	

	
	echo"<p></p>";
	echo "You are renting Vehicle Number <strong>$vehicleId</strong> which is a ";
	if($size === 'van'){
		echo "<strong>van.</strong>";
	}
	else{
		echo  "<strong>$size</strong> foot truck.";
	}
	echo"<p></p>";
	echo "You're rental is from ";
	echo "<strong>$startout</strong>";
	echo " to ";
	echo "<strong> $endout </strong>";
	echo ".";
	echo "<p></p>";
	echo("<table border=1 class='tableing'>");
	echo
	"<tr><th>First Name</th><td>" .$firstname  . "</td></tr>"
    ."<tr><th>Last Name</th><td>"  .$lastname  . "</td></tr>"
	."<tr><th>Birth Date</th><td>"  .date("m/d/Y", strtotime($birthdate)) . "</td></tr>"
	."<tr><th>Street Address</th><td>"  .$streetaddress . "</td></tr>"
	."<tr><th>City</th><td>"  .$city  . "</td></tr>"
	."<tr><th>State</th><td>"  .$state  . "</td></tr>"
	."<tr><th>Zip Code</th><td>"  .$zip  . "</td></tr>"
	."<tr><th>Company</th><td>"  .$company . "</td></tr>";
	echo '</table>';
	echo"<p></p>";
	echo"<p></p>";
	echo "<p>Confirm that all the above information is correct and then click the submit button to finish.</p>" ;

	?>	

		<form action= "confirm.php" method="post">
		<input type="submit" value="submit" name="submit">
		</form>

			<?php
		
			if(isset($_POST['submit']))
			{
				//duplicate check
				
				$sql="SELECT customerId, firstname, lastname, email FROM customer WHERE firstname = '". $firstname."' AND lastname = '". $lastname."' AND email = '". $email."' ";
				$result= mysqli_query($conn, $sql) or die(mysqli_error($conn));
				if(mysqli_num_rows($result)<>"0" or null){
					while($row = mysqli_fetch_assoc($result)){
						if($row['firstname']==$firstname and $row['lastname']==$lastname and $row['email']==$email ){	
							$customerId=$row['customerId'];
						}
					}
				}
				mysqli_free_result($result);
				
				if($customerId<> 0 or null){
					mysqli_stmt_execute($stmt2);
					echo "Thank You for your continued business.";
				}
				else{
					
								mysqli_stmt_execute($stmt1);
								$customerId = mysqli_insert_id($conn);
								if($customerId==="0"){
								echo "Failed to insert customer data";
								exit();
								}
								else{
								//printf("Error: %s.\n", mysqli_stmt_error($stmt1));
								mysqli_stmt_close($stmt1);
								mysqli_stmt_execute($stmt2);
								//printf("Error: %s.\n", mysqli_stmt_error($stmt2));
								}
						
						}
							
					
						
						$rentId = mysqli_insert_id($conn);
						if($rentId <> "0" or null and $customerId <>"0" or null){
						echo "<p>Rental Registered</p>";}
						else{ echo "<p>Registration failed. </p>";}
						mysqli_stmt_close($stmt2);
						mysqli_close($conn);
			
			}

		
		
			?>
</div></body>
</html>