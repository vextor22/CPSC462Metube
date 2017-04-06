<html>
<body>
<?php

session_start();
include_once "function.php";
?>
<!-- Possibly here need to make a function that will pull from the accout
	table that will get the information we need-->
<p>Welcome <?php echo $_SESSION['username'];?></p>
<?php 
	$username = $_SESSION['username'];
	$query = "SELECT firstName, lastname, age, aboutMe FROM account WHERE username='$username'";
	$result = mysql_query($query);
	if (!$result){
		die("User does not exist".mysql_error());
	}
	else {
		$row = mysql_fetch_row($result);
		$first = $row[0];
		echo $first;
		$last = $row[1];
		$age = $row[2];
		$aboutMe = $row[3];
	}
?>

</body>
</html>
