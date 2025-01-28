<!doctype html> 
	
<html lang="en"> 

<head> 
	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
<title>Login-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
</head> 
	<script>
function register() {
  location.replace("http://localhost:81/Vsocial/Register.php")
}
function home() {
  location.replace("http://localhost:81/Vsocial/Home.php")
}

</script>
	
<body style="background-image: url(http://localhost:81/VSocial/dash.jpg); background-position: center"> 
	
	
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
	$dbpassword='';
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
		
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$timestamp = date('m/d/Y h:i:s a', time());
		$logdescription = "Failed User Login Attempt! Username:".htmlentities($username)." Password:".htmlentities($password)."<br/>UserAgent:".$_SERVER['HTTP_USER_AGENT'];
		$logsql = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
		$logresult = mysqli_query($conn, $logsql);
		
	}
	
	else if(($password == $dbpassword)) {
		
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$timestamp = date('m/d/Y h:i:s a', time());
		$logdescription = "Login Success! Username:".htmlentities($username)."<br/>UserAgent:".$_SERVER['HTTP_USER_AGENT'];
		$logsql = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
		$logresult = mysqli_query($conn, $logsql);
		
		$dashboard = "http://localhost:81/Vsocial/Dashboard.php?user=".$username;
		session_start();
		$cookie_name = "user";
		$cookie_value = "$username";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		
		$cookie_name = "isloggedin";
		$cookie_value = "true";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		
		$cookie_name = "isadmin";
		$cookie_value = "false";
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
$dbpassword;	
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