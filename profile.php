<head>
	<title>Profile Page</title>
</head>

<html>
<body>
<?php

session_start();
include_once "function.php";
include('nav-bar.php')
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
<!-- 
<form> 
<button onclick=
-->

<h1><?php echo $first;?> <?php echo $last;?>'s Profile Page</h1>

<div class="btn-group">
	<a href="./channels.php" class="btn btn-default">Channels</a>
</div>

<p>
Name: <?php echo $first;?> <?php echo $last;?> <br>
Age: <?php echo $age;?><br>
About Me:<br> <textarea rows="10" cols="50"><?php echo $aboutMe?></textarea>

</p>

<p>Uploads by <?php echo $username?></p>

<?php
	$query = "SELECT * FROM media WHERE username='$username'";
	$result = mysql_query($query);

?>

	<table>
		<?php
		while($result_row = mysql_fetch_row($result)){
			$mediaId = $result_row[3];
			$filename = $result_row[0];
            $path = $result_row[4]; 
            $title = $result_row[5];
            if(strlen($title) == 0){
                $title = $filename;
            }
            ?>
		<tr>
		<td style="text-align:center">
			<a href="media.php?id=<?php echo $mediaId;?>" target="_self"><?php echo $title;?></a>
		</td>
		</tr>	

	<?php
	}?>
	</table>

</body>
</html>
