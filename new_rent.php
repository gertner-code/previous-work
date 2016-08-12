
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

if(isset($_POST['submit']))
			{
				//mysqli_autocommit($conn, TRUE);
				//var_dump($_REQUEST);
				$size = $_POST['size'];
				$startdate = $_POST['startdate'];
				$enddate = $_POST['enddate'];
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$birthdate = $_POST['birthdate'];
				$streetaddress = $_POST['streetaddress'];
				$city = $_POST['city'];
				$state = $_POST['state'];
				$zip = $_POST['zip'];
				$email = $_POST['email'];
				if($_REQUEST['company'] != null){
					$company= $_POST['company'];
				}
				else{
					$company= null;
				}
				
				
				date_default_timezone_set('America/New_York');
			
				$current_date= date('Y-m-d');
				
				
				
				$sql = "SELECT v.vehicleId 
						FROM vehicles v
						WHERE v.size = '$size' AND
						v.vehicleId NOT IN (SELECT r.vehicleId 
							  FROM rental r 
							  WHERE r.startdate <= '$enddate' AND
									r.enddate >= '$startdate'
							 ) ORDER BY RAND() LIMIT 1;" ;
				$result = mysqli_query($conn, $sql);
				
			
				//echo "<p>$sql</p>";
				while($row= mysqli_fetch_array($result))
				{
				$vehicleId= $row['vehicleId'];
				}
				//echo $vehicleId;
				
				
				
				if(mysqli_num_rows($result) === 0 )
				{
					echo "Vehicles of this type are unavailalbe during this timeframe.";
					exit();
					
				}
				elseif($enddate<$startdate or $startdate<$current_date){
					echo "<p>The dates are incorrect</p>";
				}
				else
				{
					$diff = abs(strtotime($enddate)- strtotime($startdate) );
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));


					$sql="SELECT price FROM price WHERE size= '$size' ;";
					$result = mysqli_query($conn, $sql);
					while($row= mysqli_fetch_array($result))
					{
						$price= $row['price'];
					}
					$cost = round((($days + 1) * $price), 2) ;
				}
				
				
				//insert customer info
				$stmt1 = mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt1, "INSERT INTO customer (firstname, lastname, birthdate, streetaddress, city, state, zip, email, company) VALUES (?,?,?,?,?,?,?,?,?)");
				mysqli_stmt_bind_param($stmt1, 'sssssssss', $firstname, $lastname, $birthdate, $streetaddress, $city, $state, $zip, $email, $company);
				//insert rental info
				$stmt2 = mysqli_stmt_init($conn);
				mysqli_stmt_prepare($stmt2, "INSERT INTO rental (customerId, vehicleId, startdate, enddate, cost) VALUES (?,?,?,?,?)");
				mysqli_stmt_bind_param($stmt2, 'iisss', $customerId, $vehicleId, $startdate, $enddate, $cost);
				
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
		
				if($customerId<> 0 or null){		//echo $customerId;
					mysqli_stmt_execute($stmt2);
					echo "Thank You for your continued business.";
				}
						
				else
				{
								mysqli_stmt_execute($stmt1);
								$customerId = mysqli_insert_id($conn);
								//echo $customerId;
								if($customerId===0){
									echo "Failed to insert customer data";
									exit();
								}
								else{
								//printf("Error: %s.\n", mysqli_stmt_error($stmt1));
									mysqli_stmt_close($stmt1);
									mysqli_stmt_execute($stmt2) or $die("Failed to enter rental:" .mysqli_error());
								//printf("Error: %s.\n", mysqli_stmt_error($stmt2));
								}
				}
								
							
					
						
						$rentId = mysqli_insert_id($conn);
						if($rentId <> "0" or null and $customerId <> "0" or null){
						echo "<p>Rental Registered</p>";}
						else{ echo "<p>Registration failed. </p>";}
			 
			
			mysqli_stmt_close($stmt2);
			mysqli_close($conn);
		
			}

		
?>








<h1>Full Length Rental Form: </h1>

<form action="new_rent.php" method="post">     
			<p>Vehicle Type<br/>
			<select name="size">
				<option value="van">van</option>
				<option value="12">12'</option>
				<option value="16">16'</option>
				<option value="22">22'</option>
				<option value="26">26'</option>
			</select></p>
			<p>Start Date<br/>
			<input type="date" name="startdate" required></p>
			<p>End Date<br/>
			<input type="date" name="enddate" required></p>
			<p>First Name:<br/>
			<input type="text" name="firstname" maxlength="20" required></p>
			<p>Last Name:<br/>
			<input type="text" name="lastname" maxlength="20" required></p>
			<p>Birth Date:<br/>
			<input type="date" name="birthdate"></p>
			<p>Street Address:
			<br/><input type="text" name="streetaddress" maxlength="50" required></p>
			<p>City:<br/>
			<input type="text" name="city" required></p>
			<p>State:<br/>
			<select name= "state">
			<option value="AK">AK</option> 
			<option value="AL">AL</option> 
			<option value="AR">AR</option> 
			<option value="AZ">AZ</option> 
			<option value="CA">CA</option>
			<option value="CO">CO</option> 
			<option value="CT">CT</option>
			<option value="DE">DE</option> 
			<option value="FL">FL</option> 
			<option value="GA">GA</option> 
			<option value="HI">HI</option> 
			<option value="IA">IA</option> 
			<option value="ID">ID</option> 
			<option value="IL">IL</option> 
			<option value="IN">IN</option> 
			<option value="KS">KS</option> 
			<option value="KY">KY</option> 
			<option value="LA">LA</option> 
			<option value="MA">MA</option> 
			<option value="MD">MD</option> 
			<option value="ME">ME</option> 
			<option value="MI">MI</option> 
			<option value="MN">MN</option> 
			<option value="MO">MO</option> 
			<option value="MS">MS</option> 
			<option value="MT">MT</option> 
			<option value="NC">NC</option> 
			<option value="ND">ND</option> 
			<option value="NE">NE</option> 
			<option value="NH">NH</option> 
			<option value="NJ">NJ</option> 
			<option value="NM">NM</option> 
			<option value="NV">NV</option>
			<option value="NY">NY</option> 
			<option value="OH">OH</option> 
			<option value="OK">OK</option> 
			<option value="OR">OR</option> 
			<option value="PA">PA</option> 
			<option value="RI">RI</option> 
			<option value="SC">SC</option> 
			<option value="SD">SD</option> 
			<option value="TN">TN</option> 
			<option value="TX">TX</option> 
			<option value="UT">UT</option> 
			<option value="VA">VA</option> 
			<option value="VT">VT</option> 
			<option value="WA">WA</option> 
			<option value="WI">WI</option>
			<option value="WV">WV</option>  
			<option value="WY">WY</option>
			</select></p>
			
			
			<p>Zip Code:<br/>
			<input type="text" name="zip" maxlength= "5" pattern="[0-9]{5}" required></p>
			<p>Email:<br/>
			<input type="email" name="email" maxlength="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></p>
			<p>Company:<br/>
			<input type="text" name="company" maxlength="50" ></p>
			
			<input type="submit" value="submit" name="submit"/>
</div></body>
			
			
			

			
			
</html>