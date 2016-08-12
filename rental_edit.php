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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>‌​
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
	
	
	
	if(isset($_POST['submit'])){
		
		//echo $_POST['editting'];
		//echo $_POST['changer'];
		if($_POST['editting']=="vehicle"){
			$vehicle=$_POST['vehicle'];
			$sql1= "UPDATE rental SET vehicleId = '$vehicle'  WHERE rentalId= '$id';";
			$result= mysqli_query($conn, $sql1);
				//UPDATE cost in case vehicle type changed 
				
				
				$sqli= "SELECT rental.startdate, rental.enddate, price.price FROM rental JOIN vehicles ON rental.vehicleId=vehicles.vehicleId 
				JOIN price ON vehicles.size = price.size
				WHERE rental.rentalId = '$id'";
				$result= mysqli_query($conn, $sqli);
				//echo $sqli;
				while($row= mysqli_fetch_assoc($result)){
					$price=$row['price'];
					$startdate=$row['startdate'];
					$enddate=$row['enddate'];
				}
				
				$diff = abs(strtotime($enddate)- strtotime($startdate) );
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$updatecost=round((($days + 1) * $price), 2);
				$updatesql="UPDATE rental SET cost = '$updatecost' WHERE rentalId= '$id';";
				$result=mysqli_query($conn,$updatesql);
				
				
		}
		elseif($_POST['editting']=="start"){
			$datecheck="SELECT startdate, enddate FROM rental WHERE rentalId ='$id'";
			$result= mysqli_query($conn, $datecheck);
			while($row= mysqli_fetch_assoc($result)){
					$startdate=$row['startdate'];
					$enddate=$row['enddate'];
				}
			$start=$_POST['start'];
			date_default_timezone_set('America/New_York');
			$current_date= date('Y-m-d');
			
			if($enddate<$start or $start<$current_date){
				echo "<p>The dates are incorrect</p>";
				
			}
			else{
			$sql2= "UPDATE rental SET startdate = '$start' WHERE rentalId= '$id';";
			$result= mysqli_query($conn, $sql2);
			//UPDATE cost in case vehicle type changed 
				
				
				$sqli= "SELECT rental.startdate, rental.enddate, price.price FROM rental JOIN vehicles ON rental.vehicleId=vehicles.vehicleId 
				JOIN price ON vehicles.size = price.size
				WHERE rental.rentalId = '$id'";
				$result= mysqli_query($conn, $sqli);
				//echo $sqli;
				while($row= mysqli_fetch_assoc($result)){
					$price=$row['price'];
					$startdate=$row['startdate'];
					$enddate=$row['enddate'];
				}
				
				$diff = abs(strtotime($enddate)- strtotime($startdate) );
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$updatecost=round((($days + 1) * $price), 2);
				$updatesql="UPDATE rental SET cost = '$updatecost' WHERE rentalId= '$id';";
				$result=mysqli_query($conn,$updatesql);
			
			}
			
			
		}
		elseif($_POST['editting']=="end"){
			
			$datecheck="SELECT startdate, enddate FROM rental WHERE rentalId ='$id'";
			$result= mysqli_query($conn, $datecheck);
			while($row= mysqli_fetch_assoc($result)){
					$startdate=$row['startdate'];
					$enddate=$row['enddate'];
				}
			date_default_timezone_set('America/New_York');
			$current_date= date('Y-m-d');
			
			$end=$_POST['end'];
			if($end<$startdate or $startdate<$current_date){
				echo "<p>The dates are incorrect</p>";
			}
			else{
				
				$sql3= "UPDATE rental SET enddate = '$end' WHERE rentalId= '$id';";
				$result= mysqli_query($conn, $sql3);
				
				//UPDATE cost in case vehicle type changed 
				
				
				$sqli= "SELECT rental.startdate, rental.enddate, price.price FROM rental JOIN vehicles ON rental.vehicleId=vehicles.vehicleId 
				JOIN price ON vehicles.size = price.size
				WHERE rental.rentalId = '$id'";
				$result= mysqli_query($conn, $sqli);
				//echo $sqli;
				while($row= mysqli_fetch_assoc($result)){
					$price=$row['price'];
					$startdate=$row['startdate'];
					$enddate=$row['enddate'];
				}
				
				$diff = abs(strtotime($enddate)- strtotime($startdate) );
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$updatecost=round((($days + 1) * $price), 2);
				$updatesql="UPDATE rental SET cost = '$updatecost' WHERE rentalId= '$id';";
				$result=mysqli_query($conn,$updatesql);
			}
		}
		else{
			$selector= $_POST['changer'];
			$cost=$_POST['cost'];
			//echo $selector;
			
			switch($selector){
			case "add":
			$sql4= "UPDATE rental SET cost = ROUND(cost +'$cost', 2) WHERE rentalId= '$id';";
			echo $sql4;
			break;
			case "subtract":
			$sql4="UPDATE rental SET cost = ROUND(cost -'$cost', 2) WHERE rentalId= '$id';";
			break;
			case "increase":
			$sql4= "UPDATE rental SET cost =  ROUND(cost * (1+('$cost'/100)), 2) WHERE rentalId= '$id';";
			break;
			case "decrease":
			$sql4= "UPDATE rental SET cost = ROUND(cost * (1-('$cost'/100)), 2)  WHERE rentalId= '$id';";
			break;
			default:
			echo "code failed to pass to post";
			}
			
			$result= mysqli_query($conn, $sql4);
		}
		
	}
	
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
mysqli_close($conn);
?>
<form action="rental_edit.php" method="post">
<label for "editting">select edit</label>
<select name="editting" id="editting">
	<option value="vehicle"> Change Vehicle ID</option>
	<option value="start"> Change Start Time</option>
	<option value="end"> Change End Time</option>
	<option value="cost"> Change Cost</option>
</select>
<div id="casing">
	<div id="vehicle" style= "display:none;">
	<p>Vehicle ID</p>
	<input type="text" name="vehicle">
	 </div>
	 
	 
	<div id="start" style= "display:none;" >
		<p>Start Date<br/>
		<input type="date" name="start" ></p>
	</div>
	
			
		<div id="end" style= "display:none;">	
		<p>End Date<br/>
			<input type="date" name="end"></p>
		</div>
		
	<div id="cost" style= "display:none;">
			<p>change cost by<br/>
			<select name= "changer">
			<option value="add">add flat fee</option> 
			<option value="subtract">subtract flat amount</option> 
			<option value="increase">increase by a percent</option> 
			<option value="decrease">decrease by a percent</option> 
			</select> 
			<p>(note: for percentages input the percent of the increase/decrease as a whole number)</p>
			<p>cost change<br/>
			<input type="number" name="cost" maxlength= "5"  ></p>
	</div>
	</div>
<input type="submit" value="submit" name="submit"/>

<script type="text/javascript" src="path/to/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#vehicle').hide();
$('#start').hide();
$('#end').hide();
$('#cost').hide();
$("#editting").change(function(){
$("#" + this.value).show().siblings().hide();
});

$("#editting").change();
});
</script>

</div></body>








</html>