<?php
	include 'dbconnect.php';
	$currentuser = $_COOKIE['user'];
		
	$sql = "Select * from blogs";
	$result = mysqli_query($conn, $sql);
	
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

<script>
 function dashboard() {
  location.replace("http://localhost:81/Vsocial/Dashboard.php")
}
</script>

<body> 
	
	
<div style="text-align:center;"> 
<button onclick="dashboard()">Go Back to Dashboard</button> <br/><br/>
<h2>Blog Posts</h2><br/><br/><br/>
<?php echo 'Welcome  '.$currentuser.',<br/> Below are all the Blog Posts<br/><br/>';

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
</div>
</body> 
</html> 
