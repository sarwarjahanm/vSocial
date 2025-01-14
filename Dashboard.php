<?php
$user=$_COOKIE['user'];	

$isadmin=$_COOKIE['isadmin'];

?>

<!doctype html> 
	
<html lang="en"> 

<head> 
<title>Dashboard-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
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
				var viewBlogUrl = "http://localhost:81/Vsocial/allBlog.php?back=user";
				location.replace(viewBlogUrl);
			}
			function myProfile(){
				var profileUrl = "http://localhost:81/Vsocial/profile.php";
				location.replace(profileUrl);
			}
			function photoAlbum(){
				var albumUrl = "http://localhost:81/Vsocial/myAlbum.php";
				location.replace(albumUrl);
			}
			function logout(){
				var homepage = "http://localhost:81/Vsocial/logout.php";
				location.replace(homepage);
			}
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
		</script>';
	
?>

<body style="background-image: url(http://localhost:81/VSocial/dash.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
	<h2>Vsocial Dashboard</h2><br/><br/><br/><br/><br/>
<?php echo 'Welcome  '.ucfirst($user).',&emsp;<button onclick="logout()">Log Out</button><br/><br/><br/>';

echo 'You can send messages to other users, read your inbox, view all Blogs or update your profile by clicking the following buttons.<br/><br/><br/>';


echo '<pre><button onclick="sendmsg()">Send Message</button>  <button onclick="myInbox()">My inbox</button>  <button onclick="viewblog()">View Blog</button>  <button onclick="myProfile()">My Profile</button>  <button onclick="photoAlbum()">My Photo Album</button></pre></div> ';

if($isadmin=='true'){
echo '<br/><br/><div style="text-align:center;"><pre><button onclick="manageusers()">Manage Users</button>  <button onclick="managebloggers()">Manage Bloggers</button>  <button onclick="manageBlogs()">Manage Blogs</button></pre></div> ';
}

?>
	
</body> 
</html> 
