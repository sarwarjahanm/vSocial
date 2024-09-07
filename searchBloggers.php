<?php
	include 'dbconnect.php';
	$showError = false;	
	$pic = '';
	$sql = "SELECT fname, lname, address from bloggers WHERE username=''"; 		
	$result = mysqli_query($conn, $sql);
	$cond = false;
	
?>


<!doctype html> 
	
<html lang="en"> 

<head> 
<title>searchBlogger-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<script>
 function Home() {
  location.replace("http://localhost:81/Vsocial/Home.php")
}
</script>

<body style="background-image: url(http://localhost:81/VSocial/bg.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="Home()">Back to Home</button> <br/><br/>
<h2>Search User Details</h2>
<?php 
	
	if($_SERVER["REQUEST_METHOD"] == "GET") {
		$username = $_GET["username"];
		if($username==''){
			$showError = "Enter a username and click on Search.";
		}
		
		if($cond == false){
		$sql = "SELECT fname, lname, address, pic from bloggers WHERE username='".$username."'"; 		
		$result = mysqli_query($conn, $sql);
		
		/* $sql2 = "Select pic from users where username='".$username."'";
		$result2 = mysqli_query($conn, $sql2);	
		while ($udetails = mysqli_fetch_array(
                        $result2,MYSQLI_ASSOC)):;
		$pic = $udetails["pic"];						
		endwhile; */
		
		if (mysqli_num_rows($result) > 0) {
			$cond = true;
		} else {
			if($username != ''){
			$showError = "Aww snap! No user details found for bloggername: ".$username."!";
			}
			else {
			$showError = "Enter a username and click on Search.";	
			}
		  }
		
		}
}
	
	  echo '<br/> Enter username to view the details.<br/><br/>';
	  echo '<form name="searchUser" action="http://localhost:81/Vsocial/searchBloggers.php" method="GET">
			Username <input type="text" name="username"><br/><br/>';
	  echo '<input type="submit" value="Search"></pre><br/><br/></form> ';

	if($cond == true){
		
	  echo '<table style="border: 1px solid black;margin-left:auto;margin-right:auto; "> 
				<tr style="border: 1px solid black;">
					<th style="border: 1px solid black;">First Name</th>
					<th style="border: 1px solid black;">Last Name</th>
					<th style="border: 1px solid black;">Address</th>
				</tr>';
            while ($details = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):; 
            
			$pic = $details["pic"];
			echo '<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;">'.$details["fname"].'</td>
					<td style="border: 1px solid black;">'.$details["lname"].'</td>
					<td style="border: 1px solid black;">'.$details["address"].'</td>
				  </tr>'; 
      
            endwhile; 
			
      echo '</table>';
	  echo '<img src="'.$pic.'" height=250 width=250 alt="Profile pic not found!"><br/><br/>';
	  
	}
	  
if($showError) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>'.$showError.'</strong>';
}

?>
</div>
</body> 
</html> 
