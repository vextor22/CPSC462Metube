<head>
	<title>Profile Page</title>
	<?php include('nav-bar.php')?>
</head>

<html>
<body>
<?php

session_start();
include_once "function.php";
?>
<!-- Possibly here need to make a function that will pull from the accout
	table that will get the information we need-->

<?php 
	$username = $_POST['username'];
#	echo $username;
	$query = "SELECT firstName, lastname, age, aboutMe FROM account WHERE username='$username'";
	$result = mysql_query($query);
	if (!$result){
		die("User does not exist".mysql_error());
	}
	else {
		$row = mysql_fetch_row($result);
		$first = $row[0];
		$last = $row[1];-
		$age = $row[2];
		$aboutMe = $row[3];
	}
?>
<h1><?php echo $first;?> <?php echo $last;?>'s Profile Page</h1>

<p>
Name: <?php echo $first;?> <?php echo $last;?> <br>
Age: <?php echo $age;?><br>
About Me:<br> <textarea rows="10" cols="50"><?php echo $aboutMe?></textarea>

</p>



</body>
</html>
