
<?php


?>

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

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: #f0e6e6;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: black;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}

img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 515px;
}

img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
  transform: scale(1.1);
}

</style>

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
function counts() {
  location.replace("http://localhost:81/Vsocial/userCount.php")
}
function about() {
  location.replace("http://localhost:81/Vsocial/about.html")
}
</script>
	
<body style="background-image: url(http://localhost:81/VSocial/dash.jpg); background-position: center"> 

<div class="navbar">
  <a href="#home">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Register 
      <i class="fa fa-caret-down"></i>
    </button>
	
  <div class="dropdown-content">
      <a href="http://localhost:81/Vsocial/Register.php">User Registration</a>
      <a href="http://localhost:81/Vsocial/bloggerRegister.php">Blogger Registration</a>
    </div>
  </div> 
  
    <div class="dropdown">
		<button class="dropbtn">Login 
			<i class="fa fa-caret-down"></i>
		</button>
	
		<div class="dropdown-content">
		  <a href="http://localhost:81/Vsocial/Login.php">User Login</a>
		  <a href="http://localhost:81/Vsocial/bloggerLogin.php">Blogger Login</a>
		</div>
	</div> 
  
  <div class="dropdown">
    <button class="dropbtn">Search 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="http://localhost:81/Vsocial/searchUser.php?username=">Search Users</a>
      <a href="http://localhost:81/Vsocial/searchBloggers.php?username=">Search Bloggers</a>
    </div>
  </div> 
  
   <div style="float: left;" class="dropdown">
    <button class="dropbtn">Others 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="http://localhost:81/Vsocial/userCount.php">UserCount</a>
      <a href="http://localhost:81/Vsocial/about.html">Credits</a>
    </div>
  </div> 
  
</div>
	
<div style="text-align:center;"> 
	<h2>Welcome to VSocial</h2><br/><br/><br/><br/><br/>
<p>A social page where you can register and send private messages to other users and can also publish your blogs or stories!</p>
<p>You can visit our Registration or Login page by clicking the following buttons.</p><br/>
<pre><button onclick="register()">Registration Page</button>  <button onclick="login()">User Login Page</button>  <button onclick="blogin()">Blogger Login Page</button>  <button onclick="searchUser()">Search Users</button>  <button onclick="searchBloggers()">Search Bloggers</button></pre>
<br/>
</div> 	
</body> 
</html> 