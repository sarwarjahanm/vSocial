
<!doctype html> 
	
<html lang="en"> 

<head> 
<title>RESET-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 
	<script>
function home() {
  location.replace("http://localhost:81/Vsocial/Home.php")
}
</script>
	
<body style="background-image: url(http://localhost:81/VSocial/dash.jpg); background-position: center"> 
<button onclick="home()">Home Page</button><div style="text-align:center;"><h3>vSocial RESET DB Page</h3><br/><br/></div> <br/><br/><br/><br/><br/><br/><br/>

<div style="text-align:center;">
	
	<form action="RESET.php" method="post"> 
		<div>
			<input type="submit" id="DBreset" name="DBreset" value="Reset Database"/>
		</div> 	 
	</form> 
</div> 
	
</body> 
</html> 

<?php 

$showError = false; 
$exists=false; 


	
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	
	include 'dbsetup.php';
	$database = "vsocial";
	$conn1 = mysqli_connect($servername, $username, $password, $database); 
		
		$adminpwd = mysqli_real_escape_string($conn1,'P@$$w0rd');
		
		$sql3 = "DELETE FROM users;DELETE FROM admins;DELETE FROM bloggers;DELETE FROM blogs;DELETE FROM messages;DELETE FROM logs; INSERT INTO admins(username, password, role) VALUES('admin', '$adminpwd', 'A');INSERT INTO admins(username, password, role) VALUES('Steve', 'steve', 'A');INSERT INTO users(username, password) VALUES('Bob', 'bob');INSERT INTO admins(username, password, role) VALUES('Super', 'SUPER', 'S');INSERT INTO bloggers(username, password) VALUES('blogger', 'blogger'); INSERT INTO users(username, password) VALUES('Oliver', '72545f3f86fad045a26ed54abd2bbb9f');INSERT INTO users(username, password) VALUES('Alex', '12b3638553c1f4a535a047e7003d9ac4');INSERT INTO users(username, password) VALUES('Merlin', '534b44a19bf18d20b71ecc4eb77c572f');INSERT INTO bloggers(username, password) VALUES('Thea', 'Y1hWbFpXND0=');INSERT INTO bloggers(username, password) VALUES('Flash', 'WVd4c1pXND0=');INSERT INTO bloggers(username, password) VALUES('Felicity', 'YzIxdllXcz0=');";
		
		$result3 = mysqli_multi_query($conn1, $sql3); 
		
		$showError = "DATA hard reset successful.";
		
		while(mysqli_more_results($conn1))
		{
			mysqli_next_result($conn1);
		}
	
		
}
	
?>

<?php 
	
	if($showError) { 
	
		echo ' <br/><div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		'. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close"> 
			<span aria-hidden="true">×</span> 
	</button> 
	</div> '; 
} 
		
	if($exists) { 
		echo ' <div style="text-align:right;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
	
		<strong>Error!</strong> '. $exists.'
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close"> 
			<span aria-hidden="true">×</span> 
		</button> 
	</div> '; 
	} 

?> 