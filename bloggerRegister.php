
<!doctype html> 
	
<html lang="en"> 

<head> 
<title>Blogger Register-vSocial</title>
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
function login() {
  location.replace("http://localhost:81/Vsocial/Login.php")
}
function blogger() {
  location.replace("http://localhost:81/Vsocial/bloggerLogin.php")
}
</script>
	
<body style="background-image: url(http://localhost:81/VSocial/bbg.jpg); background-position: center"> 

<div style="text-align:right;">
<button onclick="home()">Home Page</button>  <button onclick="login()">User Login</button>   <button onclick="blogger()">Blogger Login</button><br/><br/>
	<h3>Register Below</h3>
	<form action="bloggerRegister.php" method="post"> 
		<div>
			Username         <input type="text" name="username" id="username" maxlength=20/><br/><br/>
			Password         <input type="password" name="password" id="password" maxlength=20/></br><br/>
			Confirm Password <input type="password" name="cpassword" id="cpassword" maxlength=20/></br><br/>
			First Name <input type="text" name="fname" id="fname" maxlength=25/></br><br/>
			Last Name <input type="text" name="lname" id="lname" maxlength=25/></br><br/>
			Address <input type="textarea" name="address" id="address" maxlength=200/></br><br/>
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
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$address = $_POST["address"];
				
	$sql = "Select * from bloggers where username='$username'"; 
	
	$result = mysqli_query($conn, $sql); 
	
	$num = mysqli_num_rows($result); 
		
	if($num == 0) {
		if($username == "" || $password == ""){
			$showError = "Username or Password cannot be blank!";
		}			
		else{
			if(($password == $cpassword) && $exists==false) { 
					 
				$sql = "INSERT INTO `bloggers` ( `username`,`password`,`fname`,`lname`,`address`) VALUES ('$username','$password','$fname','$lname','$address')";
		
				$result = mysqli_query($conn, $sql); 
				
				$sqlc = "SELECT * FROM bloggers";
				$result2 = mysqli_query($conn, $sqlc); 				
				$ucount = mysqli_num_rows($result2);
				
				$xml = new DOMDocument('1.0', 'utf-8');
				$xml->formatOutput = true; 
				$xml->preserveWhiteSpace = false;
				$xml->load('usercount.xml');

				$element = $xml->getElementsByTagName('counts')->item(0); 
				$usercount = $element->getElementsByTagName('bloggers')->item(0);

				$usercount->nodeValue = $ucount;
				htmlentities($xml->save('usercount.xml'));
				
		
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