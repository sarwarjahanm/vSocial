<?php
	include 'dbconnect.php';
	$me = "";
	if($_SERVER["REQUEST_METHOD"] == "GET") {
	$me = $_GET["username"];
	} 
	$showError = false;
	$showSuccess = false;
	$totp = substr(str_shuffle("0123456789"), 0, 4);
	
?>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
$newPass = $_POST["npass"];
$confPass = $_POST["cpass"];
$user = $_POST["uname"];
$me = $user;
$otp = $_POST["otp"];
$hotp = $_POST["htotp"];


	if(($newPass == $confPass) && ($newPass != "" && $confPass != "") && ($otp == $hotp)){
		$showSuccess = "If the user exists, then Password has been Changed Successfully for the user!";
		$epwd = md5($newPass);
		$sql = "UPDATE `users` SET password='".$epwd."' WHERE username='".$user."'"; 
		mysqli_query($conn, $sql);
		
	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$timestamp = date('m/d/Y h:i:s a', time());
	$logdescription = "Password changed for ".htmlentities($user);
	$logsql = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
	$logresult = mysqli_query($conn, $logsql);
		
	
	}
	else{
		if(($newPass == "" || $confPass == "") || ($newPass != $confPass)){
		$showError = "Password fields cannot be blank and both values must match!";	
		}	
		if($otp != $hotp){
			$showError = "Wrong OTP";	
		}
	}

}
?>

<!doctype html> 
	
<html lang="en"> 

<head> 
<title>ChangePassword-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<script>
function home(){
				var profileUrl = "http://localhost:81/Vsocial/Login.php";
				location.replace(profileUrl);
			}
</script>

<body style="background-image: url(http://localhost:81/VSocial/dbg.jpg); background-position: center"> <button onclick="home()">Login Page</button>
	
	
<div style="text-align:center;"> 

<?php echo '<h3>Hi  '.ucfirst($me).', Change your Password Below </h3><br/><br/>';

echo '<form name="changepassword" action="http://localhost:81/Vsocial/ForgotPassword.php" method="POST">
<div style="text-align:center;">
	Username <input name="uname" type="text" maxlength=30 value="'.$me.'" readonly="readonly"/><br/><br/>
	OTP <input name="otp" type="password" maxlength=4/><br/><br/>
	New Password <input name="npass" type="password" maxlength=30/><br/><br/> 
	Confirm Password <input name="cpass" type="password" maxlength=30/><br/><br/> 
	<input name="htotp" type="text" hidden="hidden" value='.$totp.'><br/>
</div>';
echo '<input type="submit" value="Change Password"></pre></form> ';

if($showError) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Error!</strong> '.$showError;
}
if($showSuccess) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Success!</strong> '.$showSuccess;
}

?>

	
</body> 
</html> 
