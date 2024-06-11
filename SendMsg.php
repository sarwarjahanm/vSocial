<?php
	include 'dbconnect.php';
	$sender = $_COOKIE['user'];
	$showError = false;
	$showSuccess = false;
	
	$sql = "Select username from users";
	$result = mysqli_query($conn, $sql);
	
?>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST["Recipients"];
$message = $_POST["message"];

	if($message != " "){
		$showSuccess = "Your message was sent to ".$username;
		$sql1 = "INSERT INTO `messages` ( `username`, 
					`message`,`sender`) VALUES ('$username', 
					'$message','$sender')"; 
		
		$result1 = mysqli_query($conn, $sql1);
	}
	else{
		$showError = "You cannot send a blank message!";		
	}

}
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
	<h2>Send Message to other users.</h2><br/><br/><br/><br/><br/>
<?php echo 'Welcome  '.$sender.',<br/><br/><br/>';

echo 'Select a user from User List drop down and send your message<br/><br/><br/>';

echo '<form name="sendsms" action="http://localhost:81/Vsocial/SendMsg.php" method="POST">
<select name="Recipients">';
            while ($recipients = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):; 
            
                echo '<option value="'.$recipients["username"].'">'.$recipients["username"].'</option>';     
      
            endwhile; 
             
echo '</select>';
echo '<pre><textarea name="message"> </textarea><br/>
<input type="submit" value="Send Message"></pre></form> ';

if($showError) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Error!</strong> '.$showError;
}
if($showSuccess) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Success!</strong> '.$showSuccess;
}

?>

	
</body> 
</html> 
