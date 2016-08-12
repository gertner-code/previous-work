	<?php
		$db_name = "truckrent.db";
		$un = "root";
		$pw = "";
		$host= "localhost";
		
		$conn = mysqli_connect($host, $un, $pw, $db_name);
		
		if(!$conn){
			die("connection failed:" . mysqli_connect_error());
		}
		//else{echo("<p>connected to mySQL Database</p>");}	
	?>
