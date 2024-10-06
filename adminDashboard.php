<?php
session_start();
$user=$_COOKIE['user'];
# $_SESSION["user"] = $user;	

?>

<!doctype html> 
	
<html lang="en"> 

<head> 
<title>Admin Dashboard-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<?php 

	echo '<script>
			function manageusers(){
				var manageusersUrl = "http://localhost:81/Vsocial/manageUsers.php?usr=All";
				location.replace(manageusersUrl);
			}
			function managebloggers(){
				var managebloggersUrl = "http://localhost:81/Vsocial/manageBloggers.php?usr=All";
				location.replace(managebloggersUrl);
			}
			function manageBlogs(){
				var manageBlogsUrl = "http://localhost:81/Vsocial/manageBlogs.php?blog=All";
				location.replace(manageBlogsUrl);
			}			
			function myProfile(){
				var profileUrl = "http://localhost:81/Vsocial/adminProfile.php";
				location.replace(profileUrl);
			}
			function logout(){
				var homepage = "http://localhost:81/Vsocial/Home.php";
				location.replace(homepage);
			}
		</script>';
	
?>

<body style="background-image: url(http://localhost:81/VSocial/aabg.png); background-position: center"> 
	
	
<div style="text-align:center;"> 
	<h2>Vsocial Admin Dashboard</h2><br/><br/><br/><br/><br/>
<?php echo 'Welcome  '.$user.',&emsp;<button onclick="logout()">Log Out</button><br/><br/><br/>';

echo 'You can perform following administrative operations.<br/><br/><br/>';


echo '<pre><button onclick="manageusers()">Manage Users</button>  <button onclick="managebloggers()">Manage Bloggers</button>  <button onclick="manageBlogs()">Manage Blogs</button>  <button onclick="myProfile()">My Profile</button></pre></div> ';



?>
	
</body> 
</html> 
