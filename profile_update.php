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
	$username = $_SESSION['username'];
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
<form id="data">
	<label>First name:</label>
		<input type="text" id="firstName" value="<?php echo $first?>" maxlength='30'> <br>
	<label> Last name:</label>
		<input type="text" id="lastname" value="<?php echo $last?>" maxlength='30'> <br>
	<label> Age:</label>
		<input type="number" id="age" value="<?php echo $age?>" min="0"> <br>
	<label>About Me:</label><br>
	<!--	<input type="text" id="aboutMe" rows="10" value="<?php echo $aboutMe?>" maxlength='4095'> -->
	<textarea rows="10" cols="50" id="id" maxlength="4095"><?php echo $aboutMe?></textarea>
</form>


</body>
</html>
