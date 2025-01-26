<?php
	include 'dbconnect.php';
	$me = $_COOKIE['user'];
	$showError = false;
	$showSuccess = false;
	
?>

<?php 

?>

<!doctype html> 
	
<html lang="en"> 

<head> 
<title>showPhotos-vSocial</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">	
	<!-- Required meta tags --> 
	<meta charset="utf-8"> 
	<meta name="viewport" content= 
		"width=device-width, initial-scale=1, 
		shrink-to-fit=no"> 
	
</head> 

<script>
function Album() {
 location.replace("http://localhost:81/Vsocial/myAlbum.php")
}
function uploadPhotos() {
 location.replace("http://localhost:81/Vsocial/uploadPhotos.php")
}
</script>

<body style="background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="Album()">Back to myAlbum</button> <br/><br/><br/>
<?php

$tmpd = "photoAlbums/";
$dirname = $tmpd.$me."/";
$publicdir = $dirname."public/";
$privatedir = $dirname."private/";
$publicimages = glob($publicdir."*.jpg");
$privateimages = glob($privatedir."*.jpg");

if(!$publicimages && !$privateimages){
	echo '<br/><br/><br/><br/><br/><br/><strong>No photos in your album yet! Upload some photos first.</strong><br/><br/>';
	echo '<button onclick="uploadPhotos()">Upload Photos</button>';
}

echo "<strong>Public Album</strong><br/>";
foreach($publicimages as $image1) {
    echo ' <img height=300 width=300 src="'.$image1.'" /> ';
}

echo "<br/><br/><br/><strong>Private Album</strong><br/>";
foreach($privateimages as $image2) {
    echo ' <img height=300 width=300 src="'.$image2.'" /> ';
}

if($showError) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong><br/>Error!</strong> '.$showError;
}
if($showSuccess) { 
	
		echo ' <div style="text-align:center;" class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Success!</strong> '.$showSuccess;
}

?>

	
</body> 
</html> 
