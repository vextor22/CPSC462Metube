<head>
	<title>Profile Page</title>
</head>

<html>
<body>
<?php
session_start();
include_once "function.php";
include('nav-bar.php');


#<!--Getting relevant information from the acount table -->

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

#Sending data to account table to update
if(isset($_POST['submit'])){ 
	$check = user_profile_update($_SESSION['username'], $_POST['firstName'], $_POST['lastname'], $_POST['age'], $_POST['aboutMe']);
	
	#check==1 means everything went through
	if($check==1){
		header("Location: profile.php");
	 }
	#something didnt go right
	else {
		$update_error = "Profile not updated sucessfully.";
	}

}


?>
<h1><?php echo $first;?> <?php echo $last;?>'s Profile Page</h1>
<form action="profile_update.php" id="data" method="post">
	<label>First name:</label>
		<input type="text" name="firstName" value="<?php echo $first?>" maxlength='30'> <br>
	<label> Last name:</label>
		<input type="text" name="lastname" value="<?php echo $last?>" maxlength='30'> <br>
	<label> Age:</label>
		<input type="number" name="age" value="<?php echo $age?>" min="0"> <br>
	<label>About Me:</label><br>
	<!--	<input type="text" id="aboutMe" rows="10" value="<?php echo $aboutMe?>" maxlength='4095'> -->
	<textarea rows="10" cols="50"  name="aboutMe" maxlength="4095"><?php echo $aboutMe?></textarea>
	<br>	
	<input name="submit" type="submit" value="Submit">
</form>
<?php
	if(isset($update_error)){
		echo $update_error;
	}
?>

</body>
</html>
