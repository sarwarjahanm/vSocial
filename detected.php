<?php
 $protocol = $_SERVER['SERVER_PROTOCOL'];
 header("$protocol 403 Forbidden");
 header("Status: 403 Forbidden");
 header("Connection: close");
 $msg = $_SERVER["UNIQUE_ID"];
?>
<HTML><HEAD>
 <TITLE>Attack Detected!</TITLE>
</HEAD><BODY>
<br/>
<div style="text-align:center;">
<p><strong>Your attack attempt has been blocked by ModSecurity!</strong></p><br/>
<img src="hacker.jpg"/><img src="mods.jpg"/>
<P>You can search the server error log for more details with Error code: <?php echo $msg; ?></P>
</div>
</BODY></HTML>