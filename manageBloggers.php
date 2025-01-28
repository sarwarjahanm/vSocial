<?php
	include 'dbconnect.php';
	$showError = false;	
	$cond = false;
	if($_COOKIE['isloggedin'] == false) {
	
    header("location:Home.php");
    exit();
	}

$adminuser = $_COOKIE['user'];	
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$timestamp = date('m/d/Y h:i:s a', time());
$logdescription = "Manage Bloggers page accessed by: ".htmlentities($adminuser);
$logsql = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
$logresult = mysqli_query($conn, $logsql);
	
?>


<!doctype html> 
	
<html> 
<head>
<title>Manage Bloggers</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">
</head>


<script>
function dashboard() {
  location.replace("http://localhost:81/Vsocial/adminDashboard.php")
}
function delUser(usr) {
	if (confirm("This will permanently delete: "+ usr)) {
	  
	  var redirectUrl = "http://localhost:81/Vsocial/manageBloggers.php?usr="+usr;
	  location.replace(redirectUrl);
  
} else {
  location.replace("http://localhost:81/Vsocial/manageBloggers.php?usr=Alls")
}

}
</script>

<body style="background-image: url(http://localhost:81/VSocial/aabg.png); background-position: center">  <button onclick="dashboard()">Admin Dashboard</button><br/>
	
<div style="text-align:center;"> 
<h2>Update Details</h2>
<?php 
	
	if($cond == false){
		$sql = "SELECT * from bloggers"; 		
		$result = mysqli_query($conn, $sql);
		
		
			if (mysqli_num_rows($result) > 0) {
				$cond = true;
			} 
			else {
				$showError = "Aww snap! No Data found!";
				$cond = false;
			}		
	}
	if($_SERVER["REQUEST_METHOD"] == "GET") {
		
		$showError = false;
		$uname = $_GET["usr"];
		
		if($uname == "Alls"){
			$showError = "No Bloggers deleted.";
		}
		if($uname == "All"){
			$showError = "All Bloggers listed below:";
		}
		
		if($uname != "All" && $uname != "Alls"){
		$sql5 = "DELETE from Bloggers WHERE username='".$uname."'"; 		
				$result = mysqli_query($conn, $sql5);
				$count = mysqli_affected_rows($conn);
		$showError = "Deleted the user: ".$uname;
		$sql = "SELECT * from Bloggers"; 		
		$result = mysqli_query($conn, $sql);
		
			$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$timestamp = date('m/d/Y h:i:s a', time());
			$logdescription = "Blogger: ".htmlentities($uname).", has been deleted by: ".htmlentities($adminuser);
			$logsql1 = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
			$logresult = mysqli_query($conn, $logsql1);	
		
		$sqlc = "SELECT * FROM Bloggers";
		$result2 = mysqli_query($conn, $sqlc); 				
		$ucount = mysqli_num_rows($result2);
				
		$xml = new DOMDocument('1.0', 'utf-8');
		$xml->formatOutput = true; 
		$xml->preserveWhiteSpace = false;
		$xml->load('usercount.xml');
		$element = $xml->getElementsByTagName('counts')->item(0);  
		$usercount = $element->getElementsByTagName('bloggers')->item(0);
		$usercount->nodeValue = $ucount;
		htmlentities($xml->save('usercount.xml'));
		}
		
	}
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$cond = false;
		if($cond == false){
		$sql = "SELECT * from Bloggers"; 		
		$result = mysqli_query($conn, $sql);
		
		
			if (mysqli_num_rows($result) > 0) {
				$cond = true;
			} 
			else {
				$showError = "Aww snap! No Data found!";
				$cond = false;
			}		
		}
		
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$address = $_POST["address"];
		$uname = $_POST["uname"];

		if($fname == '' && $lname == '' && $address == ''){
			$showError = "All inputs are required and cannot be blank!";				
		}
		else{
				$sql = "UPDATE `Bloggers` SET fname='".$fname."', lname='".$lname."', address='".$address."' WHERE username='".$uname."'";  		
				$result = mysqli_query($conn, $sql);
				$count = mysqli_affected_rows($conn);
				
					$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					$timestamp = date('m/d/Y h:i:s a', time());
					$logdescription = "Blogger details for user: ".htmlentities($uname).", has been updated by: ".htmlentities($adminuser);
					$logsql = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
					$logresult = mysqli_query($conn, $logsql);
				
				if ($count > 0) {
					$showError = "Records updated";
				}
				else {
					$showError = "Entered Username not present in Database, so no updation happened.";
				}				
				
				$sql = "SELECT * from Bloggers"; 		
				$result = mysqli_query($conn, $sql);
		
			}
}
	
	  echo '<br/> Enter Username whose details to be updated and provide other details which will update.<br/><br/>';
	  echo '<form name="updateUser" action="http://localhost:81/Vsocial/manageBloggers.php" method="POST">
			Username <input type="text" name="uname">
			Fname <input type="text" name="fname">
			Lname <input type="text" name="lname">
			Address <input type="text" name="address"><br/><br/>';
	  echo '<input type="submit" value="Update Data"></pre><br/><br/></form> ';

if($showError) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>'.$showError.'</strong><br/>';
}

	if($cond == true){
		
	  echo '<br/><table style="border: 1px solid black;margin-left:auto;margin-right:auto; "> 
				<tr style="border: 1px solid black;">
					<th style="border: 1px solid black;">Username #</th>
					<th style="border: 1px solid black;">First Name</th>
					<th style="border: 1px solid black;">Last Name</th>
					<th style="border: 1px solid black;">Address</th>
					<th style="border: 1px solid black;">Delete User</th>
				</tr>';
            while ($details = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):; 
            
			echo '<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;">'.$details["username"].'</td>
					<td style="border: 1px solid black;">'.$details["fname"].'</td>
					<td style="border: 1px solid black;">'.$details["lname"].'</td>
					<td style="border: 1px solid black;">'.$details["address"].'</td>
	<td style="border: 1px solid black;">'.'<button onclick="delUser(\''.$details["username"].'\');">delete  '.$details["username"].'</button>'.'</td>
				  </tr>'; 
      
            endwhile; 
			
      echo '</table>';
	  
	}
	  

?>
</div>
</body> 
</html> 
