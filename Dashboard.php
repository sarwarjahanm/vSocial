<?php
session_start();
$user=$_COOKIE['user'];
# $_SESSION["user"] = $user;	

?>

<!doctype html> 
	
<html lang="en"> 

<head> 
	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<?php 

	echo '<script>
			function sendmsg(){
				var sendmsgUrl = "http://localhost:81/Vsocial/SendMsg.php";
				location.replace(sendmsgUrl);
			}
			function myInbox(){
				var mymsgUrl = "http://localhost:81/Vsocial/myInbox.php";
				location.replace(mymsgUrl);
			}
			function viewblog(){
				var viewBlogUrl = "http://localhost:81/Vsocial/allBlog.php";
				location.replace(viewBlogUrl);
			}
			function myProfile(){
				var profileUrl = "http://localhost:81/Vsocial/profile.php";
				location.replace(profileUrl);
			}
			function logout(){
				var homepage = "http://localhost:81/Vsocial/Home.php";
				location.replace(homepage);
			}
		</script>';
	
?>

<body> 
	
	
<div style="text-align:center;"> 
	<h2>Vsocial Dashboard</h2><br/><br/><br/><br/><br/>
<?php echo 'Welcome  '.$user.',&emsp;<button onclick="logout()">Log Out</button><br/><br/><br/>';

echo 'You can send messages to other users, read your inbox, view all Blogs or update your profile by clicking the following buttons.<br/><br/><br/>';


echo '<pre><button onclick="sendmsg()">Send Message</button>  <button onclick="myInbox()">My inbox</button>  <button onclick="viewblog()">View Blog</button>  <button onclick="myProfile()">My Profile</button></pre></div> ';



?>
	
</body> 
</html> 
