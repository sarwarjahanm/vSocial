
<!doctype html> 
	
<html lang="en"> 

<head> 
<title>SETUP-vSocial</title>
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
<button onclick="home()">Home Page</button><div style="text-align:center;"><h3>vSocial Setup Page</h3><br/><br/></div> <br/><br/><br/><br/><br/><br/><br/>

<div style="text-align:center;">
	
	<form action="SETUP.php" method="post"> 
		<div>
			<input type="submit" id="DBsetup" name="DBsetup" value="Setup Database"/>
		</div> 	 
	</form> <br/><br/><br/>
</div> 
	
</body> 
</html> 

<?php 

$showError = false; 
$exists=false; 
	
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	
	include 'dbsetup.php'; 
	
	//Create vsocial Database
	$sql0 = "create database vsocial";
	$result0 = mysqli_query($conn0, $sql0);
	
	$database = "vsocial";
	$conn1 = mysqli_connect($servername, $username, $password, $database); 
	
	//Create Tables	in vsocial Database		
	$sql1 = "CREATE TABLE users(username VARCHAR(30),password VARCHAR(35),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250));";
	$sql2 = "CREATE TABLE admins(username VARCHAR(30),password VARCHAR(35),role CHAR(1),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250));";
	$sql3 = "CREATE TABLE bloggers(username VARCHAR(30),password VARCHAR(100),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250));";
	$sql4 = "CREATE TABLE blogs(author VARCHAR(30),title VARCHAR(250),body VARCHAR(1500));";
	$sql5 = "CREATE TABLE messages(username VARCHAR(30),message VARCHAR(500),sender VARCHAR(30));";
	$sql6 = "CREATE TABLE logs(url VARCHAR(200),timestamp VARCHAR(50),description VARCHAR(2000));";
	
	$result1 = mysqli_query($conn1, $sql1); $result2 = mysqli_query($conn1, $sql2);	$result3 = mysqli_query($conn1, $sql3); $result4 = mysqli_query($conn1, $sql4); $result5 = mysqli_query($conn1, $sql5); $result6 = mysqli_query($conn1, $sql6);
	
	$adminpwd = mysqli_real_escape_string($conn1,'P@$$w0rd');
	
	//Insert Data in vsocial Database Tables
	$sql7 = "INSERT INTO admins(username, password, role) VALUES('admin', '$adminpwd', 'A');INSERT INTO admins(username, password, role) VALUES('Steve', 'steve', 'A');INSERT INTO users(username, password) VALUES('Bob', 'bob');INSERT INTO admins(username, password, role) VALUES('Super', 'SUPER', 'S');INSERT INTO bloggers(username, password) VALUES('blogger', 'blogger'); INSERT INTO users(username, password) VALUES('Oliver', '72545f3f86fad045a26ed54abd2bbb9f');INSERT INTO users(username, password) VALUES('Alex', '12b3638553c1f4a535a047e7003d9ac4');INSERT INTO users(username, password) VALUES('Merlin', '534b44a19bf18d20b71ecc4eb77c572f');INSERT INTO bloggers(username, password) VALUES('Thea', 'Y1hWbFpXND0=');INSERT INTO bloggers(username, password) VALUES('Flash', 'WVd4c1pXND0=');INSERT INTO bloggers(username, password) VALUES('Felicity', 'YzIxdllXcz0=');";
	
	$result7 = mysqli_multi_query($conn1, $sql7); 
	
	$showError = "vSocial Database setup Successful.";
	
	while(mysqli_more_results($conn1))
	{
		mysqli_next_result($conn1);
	}
		
}
	
?>

<?php 
	
	if($showError) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
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