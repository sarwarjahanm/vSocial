<?php
include 'dbconnect.php';
session_start();
$user=$_COOKIE['user'];
	if(!isset($_COOKIE['Role'])) {
		$cookie_name = "Role";
		$cookie_value = "U";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
	}
$role=$_COOKIE['Role'];
# $_SESSION["user"] = $user;
	
	if($role != "S") {
	echo '<style>#manageAdmin{visibility: hidden}</style>';
	}
	
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
			function manageadmins(){
				var manageadminsUrl = "http://localhost:81/Vsocial/manageAdmins.php?usr=All";
				location.replace(manageadminsUrl);
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
			function eventLogs(){
				var eventLogUrl = "http://localhost:81/Vsocial/eventLogs.php";
				location.replace(eventLogUrl);
			}
			function logout(){
				var homepage = "http://localhost:81/Vsocial/logout.php";
				location.replace(homepage);
			}
		</script>';
	
?>

<body style="background-image: url(http://localhost:81/VSocial/aabg.png); background-position: center"> 
	
	
<div style="text-align:center;"> 
	<h2>Vsocial Admin Dashboard</h2><br/><br/><br/><br/><br/>
<?php echo 'Welcome  '.ucfirst($user).',&emsp;<button onclick="myProfile()">My Profile</button>&emsp;<button onclick="logout()">Log Out</button><br/><br/><br/>';

echo 'You can perform following administrative operations.<br/><br/><br/>';
echo '<button onclick="manageadmins()" id="manageAdmin">Manage Admins</button>';
echo '<pre><button onclick="manageusers()">Manage Users</button>  <button onclick="managebloggers()">Manage Bloggers</button>  <button onclick="manageBlogs()">Manage Blogs</button>  <button onclick="eventLogs()">Event Logs</button></pre></div> ';



?>
	
</body> 
</html> 
