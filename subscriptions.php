<head>
	<title>Subscriptions Page</title>
</head>

<html>
<body>
<?php
session_start();
include_once "function.php";
include('nav-bar.php');

$username = $_SESSION['username'];
$query = "SELECT * FROM subscriptions WHERE username='$username'";
$subsResult = mysql_query($query);
?>

<table style=table-layout:hover;>

	<tr align="center"><th><?php echo $username;?>'s Subscriptions</th></tr>

	<?php
	while ($subsRow = mysql_fetch_row($subsResult)) {
		$channelid = $subsRow[1];

		#getting the channel information
		#subid channelid username channelid channeltitle username desc
		$channelQuery = "SELECT * FROM subscriptions JOIN channel WHERE channel.channelid = subscriptions.channelid"
			or die ("The subscriptions you requested do not exist or have no content to display".mysql_error());
		$channelResult = mysql_query($channelQuery);
		$channelRow = mysql_fetch_row($channelResult);

		$channelName = $channelRow[4]

		?>
		<tr>
		<td><a href="channel.php?id=<?php echo $channelid?>" target="_blank"><?php echo $channelName;?></a>
		</td>
		</tr>
	<?php
	} ?>



</table>

</body>
</html>
