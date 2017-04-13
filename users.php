<head>
	<title>Users</title>
	<?php include('nav-bar.php')?>
	<script type="text/javascript" src"js/jquery-latest.parck.js"> </script>
</head>

<html>
<body>
	<?php
		session_start();
		include_once "function.php";
	?>

<!--Display all registered users on this page-->

	<?php
		$user_array = array();

		$query = "SELECT username FROM account";
		$result = mysql_query( $query );
		
#		while($result_row = mysql_fetch_row($result)){
#			$user = $result_row[0];
#			echo $user;
#		}
#		$user_array = mysql_fetch_array($result);
#		$numUsers = count($user_array);
		
#		for ($i=0; $i <= $numUsers; $i++){
#			echo "<tr><td>".$user_array[$i]."</td></tr>";
#		}
	?>

	<table style="table-layout:fixed;" class="table table-hover">

	<?php

	$i = 0;
	$maxCols = 2;
	
	#for each user in the database, display their user name in 2 columns and 
	# when clicked on take them to that users profile page
	while ($result_row = mysql_fetch_row($result)) {
		
		$user = $result_row[0];
	
		if ($i % $maxCols == 0) { ?>	
		<tr><?php 
		}
		$i = ($i+1) % $maxCols;
		?>

			
		<form method="post" id="userForm<?php echo $user;?>" action="user_profile.php">
			<input type="hidden" name="username" value="<?php echo $user; ?>" />
		</form>
		<td style="text-align:center">
			<a style="cursor:pointer; cursor:hand;"  onclick="javascript:document.getElementById('userForm<?php echo $user?>').submit();"><?php echo $user;?></a>
		</td>
		<?php if ($i % $maxCols == 0) { ?>
		</tr>
		<?php
		}

	}
#	echo $user;
	?>
	<br>
	</table>

	<?php
#		if(isset($_POST['username'])){
#			echo $_POST['username'];
		#	header("Location: user_profile.php");
#		}
	?>

</body>
</html>
