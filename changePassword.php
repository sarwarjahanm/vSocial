<?php
	include 'dbconnect.php';
	$me = $_COOKIE['user'];
	$showError = false;
	$showSuccess = false;
	
?>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
$newPass = $_POST["npass"];
$confPass = $_POST["cpass"];
$user = $_POST["uname"];


	if(($newPass == $confPass) && ($newPass != "" && $confPass != "")){
		$showSuccess = "Password Changed Successfully!";
		$sql = "UPDATE `users` SET password='".$newPass."' WHERE username='".$user."'"; 
		
		mysqli_query($conn, $sql);
	}
	else{
		$showError = "Password fields cannot be blank and both values must match!";		
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
function myProfile(){
				var profileUrl = "http://localhost:81/Vsocial/profile.php";
				location.replace(profileUrl);
			}
</script>

<body style="background-image: url(http://localhost:81/VSocial/dbg.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="myProfile()">My Profile</button> <br/><br/>
<?php echo '<h3>Hi  '.$me.', Change your Password Below </h3><br/><br/>';

echo '<form name="changepassword" action="http://localhost:81/Vsocial/changePassword.php" method="POST">
<div style="text-align:center;">
	Username <input name="uname" type="text" maxlength=30 value="'.$me.'" readonly="readonly"/><br/><br/>
	New Password <input name="npass" type="password" maxlength=30/><br/><br/> 
	Confirm Password <input name="cpass" type="password" maxlength=30/><br/><br/> 
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
