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
		
		if($_POST['editting']=="address"){
			$streetaddress=$_POST['streetaddress'];
			$city=$_POST['city'];
			$state=$_POST['state'];
			$zip = $_POST['zip'];
			
			$sql1= "UPDATE customer SET streetaddress = '$streetaddress', city = '$city', 
			state='$state', zip = '$zip' WHERE customerId= '$id';";
			$result= mysqli_query($conn, $sql1) or die(mysqli_error($conn));
			
		}
		else{
			$company= $_POST['company'];
			$sql2= "UPDATE customer SET company = '$company' WHERE customerId= '$id';" ;
			$result= mysqli_query($conn, $sql2);
		}
		
	}
		
	$sql="SELECT * FROM customer WHERE customerId = '$id';";
	$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if(mysqli_num_rows($result) > "0"){
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
	}
	else {
		echo "0 results";
	}
	mysqli_free_result($result);
	
	

?>
<form action="customer_edit.php" method="post">
<label for "editting">select edit type</label>
<select name="editting" id="editting"  >
	<option >-----------------------</option>
	<option value="address"> Change Address</option>
	<option value="company"> Change Company</option>
</select>
<div id"choices"> 
<div id="address" style= "display:none;">
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
</div>
<div id="company" style= "display:none;">

	<p>Company:<br/>
	<input type="text" name="company" maxlength="50" ></p>
</div>

</div>
	<input type="submit" value="submit" name="submit"/>

<script type="text/javascript" src="path/to/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#address').hide();
$('#company').hide();
$("#editting").change(function(){
$("#" + this.value).show().siblings().hide();
});

$("#editting").change();
});
</script>

<?php
	mysqli_close($conn);
?>


</div></body>








</html>