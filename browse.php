<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
    include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en">
<title>Media browse</title>

<script type="text/javascript">
function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message) 
    { }
 	);
} 
</script>


<?php include('nav-bar.php') ?>
</head>

<body>
<?php

	$query = "SELECT * from media"; 
	$result = mysql_query( $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
?>
<div class="centerer">    

    <div style="text-align: left; display: inline-block;">
    <div><h3>Browse Uploaded Media</h3></div>
        <hr />
		<?php
			while ($result_row = mysql_fetch_row($result)) //filename, username, type, mediaid, path
			{ 
				$mediaid = $result_row[3];
				$filename = $result_row[0];
                $filenpath = $result_row[4];
                $title = $result_row[5];
                $description = $result_row[6];
                $uploadBy = $result_row[1];
                if(strlen($title) == 0){
                    $title = $filename;
                }
		?>
            <div style="min-width: 500px; max-width: 700px;">
            <a class="left" href="media.php?id=<?php echo $mediaid;?>" target="_self"><?php echo $title;?></a> 
            <a class="right" href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
            <p> </p>
            <div class="clear"></div>
            <p style="word-break:break-all;"><?php echo $description; ?> </p>
            <p>Uploaded by: <?php echo $uploadBy ?> </p>
            <hr style="margin-top: 10px; margin-bottom: 10px;" />
            </div>
        	<?php
			}
		?>
   </div>
</div>
</div>
</body>
</html>
