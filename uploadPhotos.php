<?php	
	include 'dbconnect.php';
	$me = $_COOKIE['user'];
	$showError = false;
	$showSuccess = false;
	
	if (isset($_POST['Privacy'])) {
	$privacy = $_POST['Privacy'];
	} else {
	$privacy = "";
	}
	
	
	$tmpd = "photoAlbums/";
	$dirname = $tmpd.$me."/";
	$publicdir = $dirname."public/";
	$privatedir = $dirname."private/";
	
	if (!is_dir($dirname)) {
		mkdir($dirname, 0777, true);
	}
	if (!is_dir($publicdir)) {
		mkdir($publicdir, 0777, true);
	}
	if (!is_dir($privatedir)) {
		mkdir($privatedir, 0777, true);
	}
	
?>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {		
			
	if($privacy==""){
		$showError = "Upload failed! Set Privacy of your Photo.";
	}
	else{	
    try{
		if(file_exists($_FILES['photos']['tmp_name']) || is_uploaded_file($_FILES['photos']['tmp_name'])) {
			if($privacy=="Private"){
				$albumdir = $privatedir;
			}
			if($privacy=="Public"){
				$albumdir = $publicdir;
			}			
			
			$filename = $privacy."_".$_FILES["photos"]["name"];
			$picpath = $albumdir . basename($filename);
			$filepath = $albumdir.$filename;
			move_uploaded_file($_FILES['photos']['tmp_name'], $filepath);
			$showSuccess = "Photo uploaded to your Album!";
			
	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$timestamp = date('m/d/Y h:i:s a', time());
	$logdescription = "Photo Uploaded by ".htmlentities($me);
	$logsql = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
	$logresult = mysqli_query($conn, $logsql);
	
	}
	}
	catch (Exception $e)
    {
        $showError = "Photo upload failed!!";
    }
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
<pre>           Select Photo <input type="file" name="photos" id="photos"/> 

<div>Privacy: <input type="radio" id="Private" name="Privacy" value="Private"> <label for="Private">Private</label> <input type="radio" id="Public" name="Privacy" value="Public"> <label for="Public">Public</label></div></pre>
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
