
<!doctype html> 
	
<html lang="en"> 

<head> 
	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 

<title>Home-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">
	
</head> 
	<script>
function register() {
  location.replace("http://localhost:81/Vsocial/Register.php")
}
function login() {
  location.replace("http://localhost:81/Vsocial/Login.php")
}
function blogin() {
  location.replace("http://localhost:81/Vsocial/bloggerLogin.php")
}
function searchUser() {
  location.replace("http://localhost:81/Vsocial/searchUser.php?username=")
}
function searchBloggers() {
  location.replace("http://localhost:81/Vsocial/searchBloggers.php?username=")
}
</script>
	
<body style="background-image: url(http://localhost:81/VSocial/bg.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
	<h2>Welcome to VSocial</h2><br/><br/><br/><br/><br/>
<p>A social page where you can register and send private messages to other users and can also publish your blogs or stories!</p>
<p>You can visit our Registration or Login page by clicking the following buttons.</p><br/>
<pre><button onclick="register()">Registration Page</button>  <button onclick="login()">User Login Page</button>  <button onclick="blogin()">Blogger Login Page</button>  <button onclick="searchUser()">Search Users</button>  <button onclick="searchBloggers()">Search Bloggers</button></pre>
</div> 
	
</body> 
</html> 


<?php 
	

?> 