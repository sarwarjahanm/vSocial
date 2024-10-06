<?php
	include 'dbconnect.php';
	$showError = false;	
	$showSuccess = false;
	
?>


<!doctype html> 
	
<html lang="en"> 

<head> 
<title>userCount-vSocial</title>
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

function validateForm() {
  var param = document.userCount.count.value;
  if(param == "default"){
  alert("Select a value from dropdown list to display the user count!");
  return false;
  }
  
  else if(param == "users"){
		
		
  }
  
  else if(param == "bloggers"){
		
		
  }
  
  /* else if(param == "users"){
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "http://localhost:81/Vsocial/userCount.php");
		xhr.setRequestHeader("Content-Type", "text/xml");
		var data = "<?xml version=\"1.0\" encoding=\"utf-8\"?><count>"+param+"</count>";
		xhr.send(data);
		//return false;
  }
  
  else if(param == "bloggers"){
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "http://localhost:81/Vsocial/userCount.php");
		xhr.setRequestHeader("Content-Type", "text/xml");
		var data = param;
		var data = "<?xml version=\"1.0\" encoding=\"utf-8\"?><count>"+param+"</count>";	
		xhr.send(data);
		//return false;
  } */
  
}

</script>

<body style="background-image: url(http://localhost:81/VSocial/bg.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="Home()">Back to Home</button> <br/><br/>
<h2>Count Number of Users</h2>
<?php 
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
			$param = $_POST["count"];
		
				$xml = new DOMDocument('1.0', 'utf-8');
				$xml->formatOutput = true; 
				$xml->preserveWhiteSpace = false;
				$xml->load('usercount.xml');

				$element = $xml->getElementsByTagName('counts')->item(0);  
				$usercount = $element->getElementsByTagName('users')->item(0);
				$bloggercount = $element->getElementsByTagName('bloggers')->item(0);

				$ucount = $usercount->nodeValue;
				$bcount = $bloggercount->nodeValue;
				
				if($param == "users"){
					$showSuccess = "Total number of users: ".$ucount;
				}
				elseif($param == "bloggers"){
					$showSuccess = "Total number of Bloggers: ".$bcount;
				}
				else{
					$showError = "Select a value from dropdown list to display the count!";
				}
		
		}
	  echo '<br/><br/>';
	  echo '<form name="userCount" action="" method="POST" onsubmit="return validateForm()">
	  			<select name="count" id="count">
				<option value="default">Select Value</option>
				<option value="users">Users</option>
				<option value="bloggers">Bloggers</option>
			</select><br/><br/>';
	  echo '<input type="submit" value="Show Count"></pre><br/><br/></form> ';

	  
if($showError) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>'.$showError.'</strong>';
}
if($showSuccess) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>'.$showSuccess.'</strong>';
}

?>
<!-- usercount.xml -->
</div>
</body> 
</html> 
