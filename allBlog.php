<?php
	include 'dbconnect.php';
	$currentuser = $_COOKIE['user'];
		
	$sql = "Select * from blogs";
	$result = mysqli_query($conn, $sql);
	
?>


<!doctype html> 
	
<html lang="en"> 

<head> 
<title>allBlog-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<script>
const params = new URLSearchParams(location.search);
var val = params.get("back");
var currentUser = document.cookie.split( ';' ).map( function( x ) { return x.trim().split( '=' ); } ).reduce( function( a, b ) { a[ b[ 0 ] ] = b[ 1 ]; return a; }, {} )[ "user" ];


 function loading(){
		 document.getElementById("user").innerHTML = currentUser;
 }

 function dashboard() {
	 
	 if(window.location.search.substring(1)=="back=blogger"){
		 location.replace("http://localhost:81/Vsocial/writeBlog.php");
	 }
	 else if(val == "user"){
		 location.replace("http://localhost:81/Vsocial/Dashboard.php");
	 }
	 else if(val == "blogger"){
		 location.replace("http://localhost:81/Vsocial/writeBlog.php");
	 }
	 else{
		document.getElementById("errmsg").innerHTML = "Return URL is invalid: "+val;
	 }
}
</script>

<body onload="loading()" style="background-image: url(http://localhost:81/VSocial/dbg.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="dashboard()">Go Back to Dashboard</button> <br/><br/>
<h2>Blog Posts</h2><br/>
<p> Welcome <b id="user"></b>,</p><br/>
<?php echo 'Below are all the Blog Posts<br/><br/>';

	  echo '<table style="border: 1px solid black;margin-left:auto;margin-right:auto; "> 
				<tr style="border: 1px solid black;">
					<th style="border: 1px solid black;">Author</th>
					<th style="border: 1px solid black;">Title of Blog</th>
					<th style="border: 1px solid black;">Body Content</th>
				</tr>';
            while ($blogs = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):; 
            
			echo '<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;">'.$blogs["author"].'</td>
					<td style="border: 1px solid black;">'.$blogs["title"].'</td>
					<td style="border: 1px solid black;">'.$blogs["body"].'</td>
				  </tr>'; 
      
            endwhile; 
			
      echo '</table>';
?>
<br/><br/><br/><p id="errmsg">If any error occurs, error messages will be displayed here!</p>
</div>
</body> 
</html> 
