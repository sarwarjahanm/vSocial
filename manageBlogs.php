<?php
	include 'dbconnect.php';
	$showError = false;	
	$cond = false;
	
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
function delBlog(blog) {
	if (confirm("This will permanently delete: "+ blog)) {
	  
	  var redirectUrl = "http://localhost:81/Vsocial/manageBlogs.php?blog="+blog;
	  location.replace(redirectUrl);
  
} else {
  location.replace("http://localhost:81/Vsocial/manageBlogs.php?blog=Alls")
}

}
</script>

<body style="background-image: url(http://localhost:81/VSocial/aabg.png); background-position: center">  <button onclick="dashboard()">Admin Dashboard</button><br/>
	
<div style="text-align:center;"> 
<h2>Manage Blogs</h2>
<?php 
	
	if($cond == false){
		$sql = "SELECT * from blogs"; 		
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
		$blogTitle = $_GET["blog"];
		
		if($blogTitle == "Alls"){
			$showError = "No Blogs deleted.";
		}
		if($blogTitle == "All"){
			$showError = "All Blog Entries listed below:";
		}
		if($blogTitle == "All" && $cond == false){
			$showError = "No Blog Entries made yet!";
		}
		if($blogTitle == "Alls" && $cond == false){
			$showError = "No Blog Entries made yet!";
		}
		
		if($blogTitle != "All" && $blogTitle != "Alls"){
		$sql5 = "DELETE from blogs WHERE title='".$blogTitle."'"; 		
				$result = mysqli_query($conn, $sql5);
				$count = mysqli_affected_rows($conn);
		$showError = "Deleted the Blog: ".$blogTitle;
		
		$sql = "SELECT * from blogs"; 		
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
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$cond = false;
		if($cond == false){
		$sql = "SELECT * from blogs"; 		
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
		
	  echo '<br/><table style="border: 1px solid black;margin-left:auto;margin-right:auto; "> 
				<tr style="border: 1px solid black;">
					<th style="border: 1px solid black;">Author</th>
					<th style="border: 1px solid black;">Title #</th>
					<th style="border: 1px solid black;">Body</th>
					<th style="border: 1px solid black;">Delete Blog</th>
				</tr>';
            while ($details = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):; 
            
			echo '<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;">'.$details["author"].'</td>
					<td style="border: 1px solid black;">'.$details["title"].'</td>
					<td style="border: 1px solid black;">'.$details["body"].'</td>
	<td style="border: 1px solid black;">'.'<button onclick="delBlog(\''.$details["title"].'\');">delete  '.$details["title"].'</button>'.'</td>
				  </tr>'; 
      
            endwhile; 
			
      echo '</table>';
	  
	}
	  

?>
</div>
</body> 
</html> 
