<?php 
include 'dbconnect.php';
$me = $_COOKIE['user'];
session_start();
$_SESSION = array();

	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$timestamp = date('m/d/Y h:i:s a', time());
	$logdescription = "User Logged Out ".htmlentities($me);
	$logsql = "INSERT INTO `logs` ( `url`,`timestamp`,`description`) VALUES ('$url','$timestamp','$logdescription')";
	$logresult = mysqli_query($conn, $logsql);

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_unset();
session_destroy();
setcookie("user", "", time() - 3600, "/");
setcookie("isloggedin", "", time() - 3600, "/");
setcookie("isadmin", "", time() - 3600, "/");
header("location:Home.php");
exit();

?> 