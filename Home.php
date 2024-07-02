
<!doctype html> 
	
<html lang="en"> 

<head> 
	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 
	<script>
function register() {
  location.replace("http://localhost:81/Vsocial/Register.php")
}
function login() {
  location.replace("http://localhost:81/Vsocial/Login.php")
}
function searchUser() {
  location.replace("http://localhost:81/Vsocial/searchUser.php")
}
</script>
	
<body> 
	
	
<div style="text-align:center;"> 
	<h2>Welcome to VSocial</h2><br/><br/><br/><br/><br/>
<p>A social page where you can register and send private messages to other users and can also publish your blogs or stories!</p>
<p>You can visit our Registration or Login page by clicking the following buttons.</p><br/>
<pre><button onclick="register()">Registeration Page</button>  <button onclick="login()">Login Page</button>  <button onclick="searchUser()">Search Users</button></pre>
</div> 
	
</body> 
</html> 


<?php 
	

?> 