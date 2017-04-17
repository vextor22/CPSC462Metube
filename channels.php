<head>
	<title>Channels Page</title>
</head>

<html>
<body>
<?php

session_start();
include_once "function.php";
include('nav-bar.php')
?>

<?php
	$username = $_SESSION['username'];
	$query = "SELECT * FROM channel WHERE username='$username'";
	$result = mysql_query($query);
	
	#if coming to this page based on viewing someone elses profile
	if (isset($_POST['username'])){
		$newUser = $_POST['username'];
		$query = "SELECT * FROM channel WHERE username='$newUser'";
		$result = mysql_query($query);?>


		<table style="table-layout:fixed;">

			<tr align="center">
				<th><?php echo $newUser;?>'s Channels</th>
			</tr>
		<?php
			while($result_row = mysql_fetch_row($result)) {
				$channelName = $result_row[1];
			$channelid = $result_row[0]; ?>

			<tr>
			<td>
				<a href=channel.php?id=<?php echo $channelid;?> target="_self"><?php echo $channelName;?></a>
			</td>
			<tr>

			<?php
			} ?>
		</table>
	<?php
	} 

	else { ?>


<table style="table-layout:fixed;">

	<tr align="center">
		<th><?php echo $username;?>'s Channels</th>
	</tr>
<?php
	while($result_row = mysql_fetch_row($result)) {
		$channelName = $result_row[1];
		$channelid = $result_row[0]; ?>

	<tr>
		<td>
			<a href=channel.php?id=<?php echo $channelid;?> target="_self"><?php echo $channelName;?></a>
		</td>
	<tr>

	<?php
	} 
	
	}?>
</table>


</body>
</html>
