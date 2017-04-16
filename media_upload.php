<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include('nav-bar.php') ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Upload</title>

<style> 

input, textarea{
    padding: 12px 20px;
    margin: 8px 0;
}

#centerer {
 text-align: center;   
}

form {
    display: inline-block;
    text-align: left;
}
</style>

</head>

<body>

<div id="centerer">
<?php 
if (isset($_SESSION['username'])) {?>

<form method="post" action="media_upload_process.php" enctype="multipart/form-data" >
 
  <p style="margin:0; padding:0">
  <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
   Add a Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
   <input  name="file" type="file" size="50" />
    <br>

    <label for="title">Title</label>
    <br>
    <input id="title" name="title" type="text" />
    <br>
    <label for="description">Description</label><br>
    <textarea name="description"  id="description" rows="10" cols="80" placeholder="Enter Description here..."></textarea> 
    <br>
       <?php
	$username = $_SESSION['username'];
	$query = "SELECT * FROM channel WHERE username='$username'";
	$result = mysql_query($query);
	?>
	<label for="channel">Channel Name</label>
	<br>
	<select name="channel" id="channel">
	<option value="newChannel">New Channel</option>
	<?php
	while($result_row = mysql_fetch_row($result)) { 
		$channelTitle = $result_row[1];?>
		<option value="<?php echo $channelTitle;?>"><?php echo $channelTitle?></option>	
    	<?php
	} ?>
	</select>
	<label for="newChannel">New Channel Name: </label>
	<input id="nchannel" name="nchannel" disabled="true" type="text" />
	<script>
		document.getElementById('channel').addEventListener('change', function(){
			if(this.value == "newChannel") {
				document.getElementById('nchannel').disabled = false;
			}
			else {
				document.getElementById('nchannel').disabled = true;
			}
		});
	</script>
    <br>
    <label for="keywords">Keywords</label><br>
    <input name="keywords" id="keywords" type="text" />
    <br>
	<input value="Upload" name="submit" type="submit" />
  </p>
 
                
 </form>
<?php }
else { echo "You must be logged in to use this feature"; }

 ?>
</div>
</body>
</html>
