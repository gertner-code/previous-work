<?php
session_start();
?>
<html>
	<head>
		<title>Rentals</title>
		<?php require_once("dbstart.php"); ?>
	<link rel="stylesheet" type="text/css" href="style.css" /></head>
	<body><div id="main">
	
	<h1>Welcome to Rentals!</h1>
	<br/>
	<p> Here you will be able to choose a vehicle to rent and tell us when you need it.</p>
	

		<form action="insert.php" method="post">     
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
			
			<input type="submit" value="Submit" name="submitted" />
		</form>
		<p></p>
		<p></p>
		
	<?php
			//
		if(isset($_POST['submitted']))
		{
			$size = $_REQUEST['size'];
			$startdate = $_REQUEST['startdate'];
			$enddate = $_REQUEST['enddate'];
			
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
				
				$_SESSION['size'] = $size;
				$_SESSION['startdate']= $startdate;
				$_SESSION['enddate'] = $enddate;
				$_SESSION['vehicleId'] = $vehicleId;
				$_SESSION['cost'] = round((($days + 1) * $price), 2) ;
				
				echo '<script type="text/javascript" language="javascript">
				document.location.href="customer.php"
				</script>';
			}
		}
		else
		{}
?>
		
	</div></body>
</html>
