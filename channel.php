<head>
	<title></title>
</head>

<html>
<body>
<?php session_start();
include_once "function.php";
include('nav-bar.php');

$channelid = $_GET['id'];

#get the channel information
$query = "SELECT * FROM channel WHERE channelid='$channelid'";
$result = mysql_query($query);
$result_row = mysql_fetch_row($result);

$channelName = $result_row[1];
$username = $result_row[2];
$description = $result_row[3];

#getting the media list
$query = "SELECT * FROM channelmedia JOIN channel WHERE channel.channelid = channelmedia.channelid AND channel.channelid='$channelid';";
$channelResult = mysql_query($query)
	or die ("The channel requested does not exist or has no content to display".mysql_error());

?>

<?php
if (isset($_POST['sub'])){
	$username = $_SESSION['username'];

	#check to make sure you are not already subscribed
	$query = "SELECT * FROM subscriptions WHERE channelid='$channelid' AND username='$username'";
	$checkQuery = mysql_query($query);
	$checkRow = mysql_fetch_row($checkQuery);
	if($checkRow == NULL){
		$query = "INSERT INTO subscriptions VALUES(NULL, '$channelid', '$username')";
		$postResult = mysql_query($query)
			or die ("Could not add subscription".mysql_error());
	}
	else {
		echo "You are already subscribed!";
	}

}
if (isset($_POST['unsub'])){
	$username = $_SESSION['username'];

	#check to make sure you are not already subscribed
	$query = "SELECT * FROM subscriptions WHERE channelid='$channelid' AND username='$username'";
	$checkQuery = mysql_query($query);
	$checkRow = mysql_fetch_row($checkQuery);
	if($checkRow == NULL){
		echo "You are not subscribed.";		
	}
	else {
		$query = "DELETE FROM subscriptions WHERE channelid='$channelid' AND username='$username'";
		$postResult = mysql_query($query)
			or die ("Could not remove subscription.".mysql_error());
	}

}


?>

<div style="text-align:center;"><?php echo $channelName;?></div>
<div style="text-align:center;"><?php echo $description;?></div>
<form action="./channel.php?id=<?php echo $channelid;?>" id="sub" method="post">
	<button class="btn btn-default" name="sub" type="submit">Subscribe</button>
	<button class="btn btn-default" name="unsub" type="submit">Unsubscribe</button>
</form>
<table class="table table-hover">
	<?php
	while($result_row = mysql_fetch_row($channelResult)){
	//chmedid channelid mediaid channelid channelTitle username description
		$mediaid = $result_row[2];

		//get the relevant media information
		$mediaQuery = "SELECT * FROM media WHERE mediaid='$mediaid';";
		$mediaResult = mysql_query($mediaQuery);
		$mediaRow = mysql_fetch_row($mediaResult);

		$filename = $mediaRow[0];
		$type = $mediaRow[2];
		$path = $mediaRow[4];
	?>
		<tr>
		<td><a href="media.php?id=<?php echo $mediaid?>" target="_blank"><?php echo $filename;?></a></td>
		<td><a href="<?php echo $path;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $path;?>);">Download</a></td>
		</tr>
	
	<?php	
	}?>	

	
</table>


</body>
</html>
