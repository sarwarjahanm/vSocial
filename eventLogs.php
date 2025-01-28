<?php
	include 'dbconnect.php';
	$showError = false;	
	$cond = false;
	
	if(!isset($_COOKIE['isloggedin'])) {
	$showError = "You are not authorised to view event logs!";
	echo '<style>#logtable{visibility: hidden}</style>';
	echo '<style>#butdash{visibility: hidden}</style>';
	}
?>


<!doctype html> 
	
<html> 
<head>
<title>Manage Blogs</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<script>
function dashboard() {
  location.replace("http://localhost:81/Vsocial/adminDashboard.php")
}
</script>

<body style="background-image: url(http://localhost:81/VSocial/aabg.png); background-position: center">  <button onclick="dashboard()" id="butdash">Admin Dashboard</button><br/>
	
<div style="text-align:center;"> 
<h2>:Event Logs:</h2>
<?php 
	
	if($cond == false){
		$sql = "SELECT * from logs"; 		
		$result = mysqli_query($conn, $sql);
		
		
			if (mysqli_num_rows($result) > 0) {
				$cond = true;
			} 
			else {
				$showError = "Aww snap! No Event Logs found!";
				$cond = false;
			}		
	}
	if($_SERVER["REQUEST_METHOD"] == "GET") {
		$cond = false;
		if($cond == false){
		$sql = "SELECT * from logs"; 		
		$result = mysqli_query($conn, $sql);
		
			if (mysqli_num_rows($result) > 0) {
				$cond = true;
			} 
			else {
				$showError = "Aww snap! No Event Logs found!";
				$cond = false;
			}		
		}
		
	}
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$cond = false;
		if($cond == false){
		$sql = "SELECT * from logs"; 		
		$result = mysqli_query($conn, $sql);
		
			if (mysqli_num_rows($result) > 0) {
				$cond = true;
			} 
			else {
				$showError = "Aww snap! No Data found!";
				$cond = false;
			}		
		}

}

if($showError) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>'.$showError.'</strong><br/>';
}

	if($cond == true){
		
	  echo '<div id="logtable"><br/><table style="border: 1px solid black;margin-left:auto;margin-right:auto; "> 
				<tr style="border: 1px solid black;">
					<th style="border: 1px solid black;">URL</th>
					<th style="border: 1px solid black;">TimeStamp</th>
					<th style="border: 1px solid black;">Description</th>
				</tr>';
            while ($details = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):; 
            
			echo '<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;">'.$details["url"].'</td>
					<td style="border: 1px solid black;">'.$details["timestamp"].'</td>
					<td style="border: 1px solid black;">'.html_entity_decode($details["description"]).'</td>
				  </tr>'; 
      
            endwhile; 
			
      echo '</table></div>';
	  
	}
	  

?>
</div>
</body> 
</html> 
