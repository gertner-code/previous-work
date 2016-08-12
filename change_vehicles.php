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
<title>Vehicle info</title>
<link rel="stylesheet" type="text/css" href="style.css" /></head>
<body><div id="main">
<a href= "home.php">Home</a>
<br/> 
<h2>Change Vehicle Price:</h2>
<br/> 
<p>Changes here will not update any rentals already in the system.</p>
<?php

require_once("dbstart.php"); 

if(isset($_POST['submit'])){
	
	mysqli_autocommit($conn, FALSE);
			$selector= $_POST['changer'];
			$cost=$_POST['cost'];
			//echo $selector;
			$vehicle=$_POST['vehicle'];
			
			if($vehicle === "all"){
				switch($selector){
					case "add":
					$sql4= "UPDATE price SET price = price + '$cost';";
					//echo $sql4;
					break;
					case "subtract":
					$sql4="UPDATE price SET price = ROUND((price - '$cost'), 2);";
					break;
					case "increase":
					$sql4= "UPDATE price SET price =  ROUND(price * (1+('$cost'/100)), 2);";
					break;
					case "decrease":
					$sql4= "UPDATE price SET price = ROUND(price * (1-('$cost'/100)), 2);";
					break;
					default:
					echo "code failed to pass to post";
					}
				
			}
			else{
					switch($selector){
					case "add":
					$sql4= "UPDATE price SET price = price + '$cost' WHERE size= '$vehicle' ;";
					$sqlanswer= mysqli_query($conn, $sql4);
					//echo $sql4;
					break;
					case "subtract":
					$sql4="UPDATE price SET price = ROUND((price - '$cost'), 2) WHERE size= '$vehicle';";
					$sqlanswer= mysqli_query($conn, $sql4);
					break;
					case "increase":
					$sql4= "UPDATE price SET price =  ROUND(price * (1+('$cost'/100)), 2) WHERE size= '$vehicle';";
					$sqlanswer= mysqli_query($conn, $sql4);
					break;
					case "decrease":
					$sql4= "UPDATE price SET price = ROUND(price * (1-('$cost'/100)), 2)  WHERE size= '$vehicle';";
					$sqlanswer= mysqli_query($conn, $sql4);
					break;
					default:
					echo "code failed to pass to post";
					}
			}
			$sqlanswer= mysqli_query($conn, $sql4);
			$sql="SELECT * FROM price ;";
				$result=mysqli_query($conn, $sql);
			
				while($row=mysqli_fetch_array($result, MYSQLI_NUM)){
					
					$rows[]=$row;
				
				}
					
				
				
				}
	




				$sql="SELECT * FROM price ;";
				$result=mysqli_query($conn, $sql);
				echo("<table border=1 class='tableing'>");
				echo("<tr><th>Size</th><th>Price</th></tr>");
				while($row = mysqli_fetch_assoc($result)) {
				echo("<tr>");
					echo "<td>" . $row['size'] . "</td>"
					."<td>" . $row['price'] . "</td>";
				echo "</tr>";
				}
				echo "</table>";
			
			


?>
	<form action="change_vehicles.php" method="post">
		<p>choose Vehicle:<br/>
			<select name= "vehicle">
			<option value="all">all</option> 
			<option value="van">van</option> 
			<option value="12">12"</option> 
			<option value="16">16"</option> 
			<option value="22">22"</option>			
			<option value="26">26"</option>  
			</select> </p>
	<p>change cost by<br/>
			<select name= "changer">
			<option value="add">add flat amount</option> 
			<option value="subtract">subtract flat amount</option> 
			<option value="increase">increase by a percent</option> 
			<option value="decrease">decrease by a percent</option> 
			</select> </p>
			<p>(note: for percentages input the percent of the increase/decrease as a whole number)</p>
			<p>cost change<br/>
			<input type="number" name="cost" maxlength= "5"  ></p>
			
	<input type="submit" value="submit" name="submit"/>
	</form>
</div></div></body>
</html>