<html>
<head>
	<title>Logout</title>
</head>
<?php 
session_start();	
include('nav-bar.php');?>

<?php
	session_destroy();
	header("refresh:1; url=index.php");

?>

<body>
	<p style="center"> Logged out. </p>
</body>
</html>
