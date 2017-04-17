<?php
session_start();
include_once "function.php";

/******************************************************
*
* upload document from user
*
*******************************************************/

$username=$_SESSION['username'];


//Create Directory if doesn't exist
if(!file_exists('uploads/'))
	mkdir('uploads/', 0757);
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
	mkdir($dirfile,0755);
	chmod( $dirfile,0755);
	if($_FILES["file"]["error"] > 0 )
	{ 	$result=$_FILES["file"]["error"];} //error from 1-4
	else
	{
		$upfile = $dirfile.urlencode($_FILES["file"]["name"]);
	  
	  if(file_exists($upfile))
	  {
	  	$result="5"; //The file has been uploaded.
	  }
	  else{
			if(is_uploaded_file($_FILES["file"]["tmp_name"]))
			{
				if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile))
				{
					$result="6"; //Failed to move file from temporary directory
				}
				else /*Successfully upload file*/
				{
					//insert into media table
					$insert = "insert into media(mediaid, filename,username,type, path, title, description, keywords)".
                            "values(NULL,'". urlencode($_FILES["file"]["name"])."','$username','".$_FILES["file"]["type"]."', '$upfile','". $_POST["title"]."','". $_POST["description"]."','". $_POST["keywords"]."')";
					$queryresult = mysql_query($insert)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());
					$result="0";
					chmod($upfile, 0644);
				}
			}
			else  
			{
					$result="7"; //upload file failed
			}
		}
	}
	
	//You can process the error code of the $result here.

	//inserting values into channel and channel medis tables
	//check to see what the value was from the drop down
	$channelName = $_POST["channel"];
	if ($channelName !="newChannel") {
		//add the media to the existing channel
		//get the channel id
		$query = "SELECT channelid FROM channel WHERE username='$username' AND channelTitle='$channelName';";
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

		
	}
	//create a new channel in channel and then add the media to channel media
	else {
		$newChannelName = $_POST["nchannel"];
		$channelDesc = $_POST["channelDesc"];

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
	}
?>

<meta http-equiv="refresh" content="0;url=browse.php?result=<?php echo $result;?>">
