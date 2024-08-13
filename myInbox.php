<?php
	include 'dbconnect.php';
	$currentuser = $_COOKIE['user'];
		
	$sql = "Select * from messages where username='$currentuser'";
	$result = mysqli_query($conn, $sql);
	
?>


<!doctype html> 
	
<html lang="en"> 

<head> 
<title>inbox-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<script>
 function dashboard() {
  location.replace("http://localhost:81/Vsocial/Dashboard.php")
}
</script>

<body style="background-image: url(http://localhost:81/VSocial/dbg.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="dashboard()">Go Back to Dashboard</button> <br/><br/>
<h2>Inbox</h2><br/>
<?php echo 'Welcome  '.$currentuser.',<br/><br/> Below are all your received messages<br/><br/>';

	  echo '<table style="border: 1px solid black;margin-left:auto;margin-right:auto; "> 
				<tr style="border: 1px solid black;">
					<th style="border: 1px solid black;">Sender</th>
					<th style="border: 1px solid black;">Message</th>
				</tr>';
            while ($inbox = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):; 
            
			echo '<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;">'.$inbox["sender"].'</td>
					<td style="border: 1px solid black;">'.$inbox["message"].'</td>
				  </tr>'; 
      
            endwhile; 
			
      echo '</table>';
?>
</div>
</body> 
</html> 
