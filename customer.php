<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Information</title>
<link rel="stylesheet" type="text/css" href="style.css" /></head>
<body><div id="main">


<?php

echo("<table border=1 class='tableing'>");
	echo "<tr>";
	
	echo
	"<td> Vehicle ID#:" . $_SESSION['vehicleId'] . "</td>"
    ."<td> Vehicle size:" . $_SESSION['size'] . "</td>"
    ."<td>Start Date:" . date("m/d/Y", strtotime($_SESSION['startdate'])) . "</td>"
    ."<td>End Date: " .  date("m/d/Y", strtotime($_SESSION['enddate'])) . "</td>"
	."<td> Total Cost:" . $_SESSION['cost'] . "</td>";
	echo '</tr>';
	echo '</table>';
	
?>
<p>Company not required</p>
<p></p>
<form action="fix.php" method="post">     
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
			
			<input type="submit" value="submit" name="submitted"/>
		</form>
		<p></p>
		<p></p>








</div></body>

</html>