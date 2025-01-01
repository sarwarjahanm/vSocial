<?php
	include 'dbconnect.php';
	$me = $_COOKIE['user'];
	$showError = false;
	$showSuccess = false;
	
	$tmpd = "photoAlbums/";
	$dirname = $tmpd.$me."/";
	
	if (!is_dir($dirname)) {
    mkdir($dirname, 0777, true);
	}
	
?>

<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    try{
		if(file_exists($_FILES['photos']['tmp_name']) || is_uploaded_file($_FILES['photos']['tmp_name'])) {
			$albumdir = $dirname;
			$picpath = $albumdir . basename($_FILES["photos"]["name"]);
			move_uploaded_file($_FILES['photos']['tmp_name'], $albumdir.$_FILES["photos"]["name"]);
			$showSuccess = "Photo uploaded to your Album!";
	}
	}
	catch (Exception $e)
    {
        $showError = "Photo upload failed!!";
    }


}
?>

<!doctype html> 
	
<html lang="en"> 

<head> 
<title>uploadPhotos-vSocial</title>
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
</script>

<body style="background-image: url(http://localhost:81/VSocial/album.jpg); background-position: center"> 
	
	
<div style="text-align:center;"> 
<button onclick="Album()">Back to myAlbum</button> <br/><br/>
<?php echo '<h3>Hi  '.ucfirst($me).', Welcome to Photo Album! </h3><br/><br/>'; 

echo '<form name="uploadPhotos" action="http://localhost:81/Vsocial/uploadPhotos.php" method="POST" enctype="multipart/form-data">
<div style="text-align:center;">
<pre>           Select Photo <input type="file" name="photos" id="photos"/></pre><br/> 
</div><br/><br/>';
echo '<input type="submit" value="Upload Photo to Album"></pre></form> ';

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
