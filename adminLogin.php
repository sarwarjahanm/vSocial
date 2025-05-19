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
	
<body style="color:white;background-image: url(http://localhost:81/VSocial/abg.jpg)"> 
	
	
<div style="text-align:right;color:white;"> 
<button onclick="home()">Home Page</button>  <br/><br/>
	<h3 style="color:white;">Admin Panel</h3>
	<form action="adminLogin.php" method="post"> 
		<div style="color:white;">
			Username <input type="text" name="username" id="username" maxlength=20/><br/><br/>
			Password <input type="password" name="password" id="password" maxlength=20/></br><br/>
			         <input type="submit" id="login" value="Login"/>
		</div> 	 
	</form>
</div><br/> 
	
</body> 
</html> 

<?php 
$dbpassword='';
$role='';
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
				
	$sqlu = "SELECT * from users"; 
	$sqlb = "SELECT * from bloggers";
	$sqla = "SELECT * from admins";
	$sqll = "SELECT * from logs";
 	
	$resultu = mysqli_query($conn, $sqlu);
	$resultb = mysqli_query($conn, $sqlb);	
	$resulta = mysqli_query($conn, $sqla);
	$resultl = mysqli_query($conn, $sqll);
	
	$userdetails = mysqli_fetch_all($resultu, MYSQLI_ASSOC);
	file_put_contents('admin/users.json', json_encode($userdetails));
	
	$bloggerdetails = mysqli_fetch_all($resultb, MYSQLI_ASSOC);
	file_put_contents('admin/bloggers.json', json_encode($bloggerdetails));
	
	$admindetails = mysqli_fetch_all($resulta, MYSQLI_ASSOC);
	file_put_contents('admin/admins.json', json_encode($admindetails));
	
	$logdetails = mysqli_fetch_all($resultl, MYSQLI_ASSOC);
	file_put_contents('admin/logs.json', json_encode($logdetails));	
	
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	 
	include 'dbconnect.php'; 
	
	$username = $_POST["username"]; 
	$password = $_POST["password"]; 
			
	
	$sql = "Select password,role from admins where username='$username'"; 
	
	$result = mysqli_query($conn, $sql); 
	
	while ($row = $result->fetch_assoc()) {
    $dbpassword = $row['password'];
	$role = $row['role'];
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
		$logdescription = "Login Success! Username:".htmlentities($username);
		$logsql = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
		$logresult = mysqli_query($conn, $logsql);
		
		$adminDashboard = "http://localhost:81/Vsocial/adminDashboard.php?user=".$username;
		session_start();
		$cookie_name = "user";
		$cookie_value = "$username";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		
		$cookie_name = "isloggedin";
		$cookie_value = "true";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		
		$cookie_name = "isadmin";
		$cookie_value = "true";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		
		$cookie_name = "Role";
		$cookie_value = $role;
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		
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
	
		echo ' <br/><div style="text-align:right;color:white;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Error!</strong> '. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close"> 
			<span aria-hidden="true">×</span> 
	</button> 
	</div> '; 
} 
 

?> 
