<?php session_start();?>
<html lang="en">
<head>
    <title>Rentals Home</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="wrapper">
		
		<div class="header">
		</div><!-- #header -->
		
		<div class="content">
		<h2>Welcome to Josh's Truck Rentals!</h2>
		<br/><br/>
		
		<p>Here we make rentals easy. Just follow the forms and your rental will be registered before you know it.</p> 
		<div class="right" style="float: right; right-margin: 5px;"><p>To get started follow the link -------> <a href= "insert.php">Start Your Rental Here</a> <------</div>
		
		</div><!-- #content -->
		
		<div class="footer">





<p>login for employees:</p>
<form method="post" action="home.php">
<input type="text" name="password" />
<input type="submit" name="submit" />

<?php
$generated_password = "admin";
if(isset($_POST['submit'])){

$password = $_POST['password'];

if($password == $generated_password){
	$_SESSION['login']="1";
	//echo $_SESSION['login'];
?>
	<script type="text/javascript">
          self.location = "employee.php"
      </script>
<?php
}

else{
	echo "<p>Incorrect Password.</p>";
}	

}

?>
	</div><!-- #footer -->
		
	</div><!-- #wrapper -->


</body>

</script>

</html>