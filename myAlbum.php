<?php
	include 'dbconnect.php';
	$me = $_COOKIE['user'];
	$showError = false;
	$showSuccess = false;
	
?>

<!doctype html> 
	
<html lang="en"> 

<head> 
<title>myAlbum-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<script>
function dashboard() {
 location.replace("http://localhost:81/Vsocial/dashboard.php")
}
function uploadPhotos() {
 location.replace("http://localhost:81/Vsocial/uploadPhotos.php")
}
function showPhotos() {
 location.replace("http://localhost:81/Vsocial/showPhotos.php")
}

</script>

<body style="background-image: url(http://localhost:81/VSocial/album.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="dashboard()">Back to Dashboard</button> <br/><br/><br/><br/>
<?php echo '<h3>Hi  '.ucfirst($me).',   Welcome to Photo Album! </h3><br/><br/><br/><br/>';

echo '<pre><button onclick="showPhotos()">View All Photos</button>         <button onclick="uploadPhotos()">Upload Photos</button></pre></div> ';

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
