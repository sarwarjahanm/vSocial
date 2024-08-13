<?php
	include 'dbconnect.php';
	$me = $_COOKIE['user'];
	$showError = false;
	$showSuccess = false;
	
?>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$addr = $_POST["addr"];




	if(file_exists($_FILES['profilepic']['tmp_name']) || is_uploaded_file($_FILES['profilepic']['tmp_name'])) {
    $picdir = "pics/";
	$picpath = $picdir . basename($_FILES["profilepic"]["name"]);
	move_uploaded_file($_FILES['profilepic']['tmp_name'], 'pics/'.$_FILES["profilepic"]["name"]);
	
	$sql2 = "UPDATE `admins` SET pic='".$picpath."' WHERE username='".$me."'"; 
	mysqli_query($conn, $sql2);
	
	}

	if($fname != "" && $lname != ""){
		$showSuccess = "Profile Updated!";
		$sql = "UPDATE `admins` SET fname='".$fname."', lname='".$lname."', address='".$addr."' WHERE username='".$me."'"; 
		
		mysqli_query($conn, $sql);
	}
	else{
		$showError = "FirstName and LastName are required fields!";		
	}

}
?>

<!doctype html> 
	
<html lang="en"> 

<head> 
<title>editProfile-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<script>
function myProfile(){
				var profileUrl = "http://localhost:81/Vsocial/adminProfile.php";
				location.replace(profileUrl);
			}
</script>

<body style="background-image: url(http://localhost:81/VSocial/aabg.png); background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="myProfile()">My Profile</button> <br/><br/>
<?php echo '<h3>Hi  '.$me.', update your details below </h3><br/><br/>';

echo '<form name="editprofile" action="http://localhost:81/Vsocial/editprofileAdmin.php" method="POST" enctype="multipart/form-data">
<div style="text-align:center;">
<pre>           Profile Pic <input type="file" name="profilepic" id="profilepic"/></pre><br/>
	First Name <input name="fname" type="text" maxlength=100/><br/><br/>
	Last Name <input name="lname" type="text" maxlength=100/><br/><br/> 
	Address <textarea name="addr"> </textarea><br/><br/> 
</div><br/><br/>';
echo '<input type="submit" value="Update My Details"></pre></form> ';

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