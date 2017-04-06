<html>
<body>

<?php
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
	if( $_POST['passowrd1'] != $_POST['passowrd2']) {
		$register_error = "Passwords don't match. Try again?";
	}
	else {
		$check = user_exist_check($_POST['username'], $_POST['passowrd1']);	
		if($check == 1){
			//echo "Rigister succeeds";
			//call the register function and pass all the parameters
			$register_check = register_new_user($_POST['username'], $_POST['passowrd1'], $_POST['firstName'],
				$_POST['lastName'], $_POST['age']);
			if($register_check == 1){
				$_SESSION['username']=$_POST['username'];
				header('Location: browse.php');
			}
		}
		else if($check == 2){
			$register_error = "Username already exists. Please user a different username.";
		}
	}
}

?>
<form action="register.php" method="post">
	Username: <input type="text" name="username"> <br>
	First Name: <input type="text" name="firstName"> <br>
	Last Name: <input type="text" name="lastName"> <br>
	Age: <input type="number" name="age"> <br>
	Create Password: <input  type="password" name="passowrd1"> <br>
	Repeat password: <input type="password" name="passowrd2"> <br>
	<input name="submit" type="submit" value="Submit">
</form>

<?php
  if(isset($register_error))
   {  echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
?>

</body>
</html>
