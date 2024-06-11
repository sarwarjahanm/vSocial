<!doctype html> 
	
<html lang="en"> 

<head> 
	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 
	<script>
function register() {
  location.replace("http://localhost:81/Vsocial/Register.php")
}
function home() {
  location.replace("http://localhost:81/Vsocial/Home.php")
}

</script>
	
<body> 
	
	
<div style="text-align:right;"> 
<button onclick="home()">Home Page</button>  <button onclick="register()">Registration Page</button><br/><br/>
	<h3>Login Below</h3>
	<form action="Login.php" method="post"> 
		<div>
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
	
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	 
	include 'dbconnect.php'; 
	
	$username = $_POST["username"]; 
	$password = $_POST["password"]; 
			
	$sql = "Select password from users where username='$username'"; 
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
		$dashboard = "http://localhost:81/Vsocial/Dashboard.php?user=".$username;
		$cookie_name = "user";
		$cookie_value = "$username";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		header("Location: $dashboard");
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