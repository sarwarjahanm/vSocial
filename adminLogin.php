<!doctype html> 
	
<html lang="en"> 

<head> 
	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
<title>AdminLogin-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
</head> 
	<script>
function home() {
  location.replace("http://localhost:81/Vsocial/Home.php")
}

</script>
	
<body style="background-image: url(http://localhost:81/VSocial/abg.jpg)"> 
	
	
<div style="text-align:right;"> 
<button onclick="home()">Home Page</button>  <br/><br/>
	<h3 style="color:white;">Admin Panel</h3>
	<form action="adminLogin.php" method="post"> 
		<div style="color:white;">
			Username <input type="text" name="username" id="username" maxlength=20/><br/><br/>
			Password <input type="password" name="password" id="password" maxlength=20/></br><br/>
			         <input type="submit" id="login" value="Login"/>
		</div> 	 
	</form> 
</div> 
	
</body> 
</html> 

<?php 
	
$showAlert = false; 
$showError = false; 
$exists=false; 
				include 'dbconnect.php';
				$sqlc = "SELECT * FROM admins";
				$result2 = mysqli_query($conn, $sqlc); 				
				$ucount = mysqli_num_rows($result2);				
				$xml = new DOMDocument('1.0', 'utf-8');
				$xml->formatOutput = true; 
				$xml->preserveWhiteSpace = false;
				$xml->load('usercount.xml');
				$element = $xml->getElementsByTagName('counts')->item(0);
				$usercount = $element->getElementsByTagName('admins')->item(0);
				$usercount->nodeValue = $ucount;
				htmlentities($xml->save('usercount.xml'));
	
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	 
	include 'dbconnect.php'; 
	
	$username = $_POST["username"]; 
	$password = $_POST["password"]; 
			
	
	$sql = "Select password from admins where username='$username'"; 
	
	$result = mysqli_query($conn, $sql); 
	
	while ($row = $result->fetch_assoc()) {
    $dbpassword = $row['password'];
	}

	if($username == ""){
				$showError = "Username or Password field is blank!";
			}
	else if($password != $dbpassword){
		$showError = "Wrong Username or Password!";
	}
	
	else if(($password == $dbpassword)) {
		$adminDashboard = "http://localhost:81/Vsocial/adminDashboard.php?user=".$username;
		$cookie_name = "user";
		$cookie_value = "$username";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		header("Location: $adminDashboard");
		die();
	
	}
	else { 
			$showError = "Something went wrong!!";
			
		}	
	
} 
	
?>

<?php 
	
	if($showError) { 
	
		echo ' <div style="text-align:right;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Error!</strong> '. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close"> 
			<span aria-hidden="true">×</span> 
	</button> 
	</div> '; 
} 
 

?> 