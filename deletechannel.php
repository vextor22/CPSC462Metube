<?php
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$channelid = $_GET['id'];

$query = "DELETE channel, channelmedia FROM channel LEFT JOIN channelmedia ON channel.channelid = channelmedia.channelid WHERE channel.channelid='$channelid'";

$result = mysql_query($query)
	or die ("Could not remove channel.".mysql_error());
?>
<meta http-equiv="refresh" content="0;url=channels.php">
