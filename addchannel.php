<head>
	<title>Add New Channel</title>
</head>
<?php
	session_start();
	include_once "function.php";
	include('nav-bar.php');
?>

<html>
<body>

<?php 
	if(isset($_POST['submit'])){
		$newChannelName = $_POST["channel"];
		$channelDesc = $_POST["channelDesc"];
		$username = $_SESSION['username'];

		$query = "INSERT INTO channel(channelid, channelTitle, username, description) VALUES(NULL, '$newChannelName', '$username', '$channelDesc');";
		$query_result = mysql_query($query)
			or die("Insert into channel error".mysql_error());

		//get the channel id
		$query = "SELECT channelid FROM channel WHERE username='$username' AND channelTitle='$newChannelName';";
		$query_result = mysql_query($query);
		$result_row = mysql_fetch_row($query_result);
		$channelid = $result_row[0];


		//get the media id
		$query = "SELECT mediaid FROM media WHERE username='$username' order by mediaid desc LIMIT 1;";
		$query_result = mysql_query($query);
		$result_row = mysql_fetch_row($query_result);
		$mediaid = $result_row[0];

		$query = "INSERT INTO channelmedia VALUES(NULL, $channelid ,$mediaid);";
		$query_result = mysql_query($query)
			or die ("Insert into channel media fails. ".mysql_error());

		header("refresh:1; url=channels.php");
	}?>

<div style="text-align:center;font-size:24px">Add a New Channel</div>
<div style="display:inline-block;text-align:left;">
	<form method="post">
		<label for="newChannel">New Channel Name: </label>
		<input id="channel" name="channel" type="text" /><br>
		<label for"channelDesc">Channel Description</label><br>
		<textarea name="channelDesc"  id="channelDesc" rows="5" cols="40" placeholder="Enter Description here..."></textarea> <br>
		<input value="Submit" name="submit" type="submit"/>
	</form>
</div>
</body>
<html>
