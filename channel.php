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
$result = mysql_query($query)
	or die ("The channel requested does not exist or has no content to display".mysql_error());

?>

<?php
if (isset($_POST['sub']){
	$query = "INSERT INTO subsctiptions VALUES(NULL, '$channelid', '$_SESSION['username']')";
	$result = mysql_query($query)
		or die ("Could not add subscription".mysql_error());

}
if (isset($_POST['unsub']){

}


?>

<div style="text-align:center;"><?php echo $channelName;?></div>
<div style="text-align:center;"><?php echo $description;?></div>
<form action="./channel.php?id=<?php echo $channelid;?>" id="sub" method="post">
	<input name="sub" type="submit" value="Subscribe">
	<input name="unsub" type="submit" value="Unsubscribe">
</form>
<table class="table table-hover">
	<?php
	while($result_row = mysql_fetch_row($result)){
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
