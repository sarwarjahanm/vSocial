
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
function home() {
  location.replace("http://localhost:81/Vsocial/Home.php")
}
function login() {
  location.replace("http://localhost:81/Vsocial/Login.php")
}
function admin() {
  location.replace("http://localhost:81/Vsocial/adminLogin.php")
}
</script>
	
<body> 

<div style="text-align:right;">
<button onclick="home()">Home Page</button>  <button onclick="login()">User Login</button>   <button onclick="admin()">Admin Login</button><br/><br/>
	<h3>Register Below</h3>
	<form action="Register.php" method="post"> 
		<div>
			Username         <input type="test" name="username" id="username" maxlength=20/><br/><br/>
			Password         <input type="password" name="password" id="password" maxlength=20/></br><br/>
			Confirm Password <input type="password" name="cpassword" id="cpassword" maxlength=20/></br><br/>
			                 <input type="submit" id="register" value="Register"/>
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
	$cpassword = $_POST["cpassword"]; 
				
	$sql = "Select * from users where username='$username'"; 
	
	$result = mysqli_query($conn, $sql); 
	
	$num = mysqli_num_rows($result); 
		
	if($num == 0) {
		if($username == "" || $password == ""){
			$showError = "Username or Password cannot be blank!";
		}			
		else{
			if(($password == $cpassword) && $exists==false) { 
					 
				$sql = "INSERT INTO `users` ( `username`, 
					`password`) VALUES ('$username', 
					'$password')"; 
		
				$result = mysqli_query($conn, $sql); 
		
				if ($result) { 
					$showAlert = true; 
				} 
			} 
			else { 
				$showError = "Passwords do not match"; 
			}
		}		
	}// end if 
	
if($num>0) 
{ 
	$exists="Username not available"; 
} 
	
}//end if 
	
?>

<?php 
	
	if($showAlert) { 
	
		echo ' <div style="text-align:right;" class="alert alert-success 
			alert-dismissible fade show" role="alert"> 
	
			<strong>Success!</strong> Your account is 
			now created and you can login. 
			<button type="button" class="close"
				data-dismiss="alert" aria-label="Close"> 
				<span aria-hidden="true">×</span> 
			</button> 
		</div> '; 
	} 
	
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