<?php
	include 'dbconnect.php';
	$currentuser = $_COOKIE['user'];
	
		
	$sql = "Select username,fname,lname,address from admins where username='".$currentuser."'";
	$result = mysqli_query($conn, $sql);
	
	$sql2 = "Select pic from admins where username='".$currentuser."'";
	$result2 = mysqli_query($conn, $sql2);
	
	while ($mydetails = mysqli_fetch_array(
                        $result2,MYSQLI_ASSOC)):;
		$pic = $mydetails["pic"];						
	endwhile;
	
?>


<!doctype html> 
	
<html lang="en"> 

<head> 
<title>Profile-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<script>
 function editProfile() {
 location.replace("http://localhost:81/Vsocial/editprofileAdmin.php")
}
function dashboard() {
 location.replace("http://localhost:81/Vsocial/adminDashboard.php")
}
</script>

<body style="background-image: url(http://localhost:81/VSocial/aabg.png); background-position: center"> 
	
	
<div style="text-align:center;"> 

<h2>My Profile</h2> <br/>
<?php 
	  echo '<img src="'.$pic.'" height=200 width=200 alt="Profile pic not uploaded yet!"><br/><br/>';

	  echo 'Welcome  '.$currentuser.',<br/> Below are your details<br/><br/>'; 

	  echo '<table style="border: 1px solid black;margin-left:auto;margin-right:auto; "> 
				<tr style="border: 1px solid black;">
					<th style="border: 1px solid black;">Username</th>
					<th style="border: 1px solid black;">First Name</th>
					<th style="border: 1px solid black;">Last Name</th>
					<th style="border: 1px solid black;">Address</th>
				</tr>';
            while ($mydetails = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):; 
            
			echo '<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;">'.$mydetails["username"].'</td>
					<td style="border: 1px solid black;">'.$mydetails["fname"].'</td>
					<td style="border: 1px solid black;">'.$mydetails["lname"].'</td>
					<td style="border: 1px solid black;">'.$mydetails["address"].'</td>
				  </tr>'; 
      
            endwhile; 
			
      echo '</table>';
?>
<br/><button onclick="editProfile()">Edit Profile</button> <br/><br/>
<br/><button onclick="dashboard()">Back to Admin Dashboard</button> <br/><br/>
</div>
</body> 
</html> 
