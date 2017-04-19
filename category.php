<?php
session_start();
include('nav-bar.php');
$fileType = $_POST['category'];
?>
<head>
	<title><?php echo $fileType;?> Media</title>
</head>

<html>
<body>
<?
#get all media from that type
$mediaQuery = "SELECT * FROM media where type='$fileType'";
$mediaresult = mysql_query($mediaQuery)
	or die ("Could not query the database for that file type".mysql_error());
?>
<div style="text-align:center;"><?php echo $fileType;?> Media</div>
<table width="50%" class="table table-hover">
	<tr>
	<td style="text-align:left">Media Name</td>
	<td style="text-align:left">Description</td>
	</tr>
	<?php
	while($mediaRow = mysql_fetch_row($mediaresult)){
		#get the media title and id
		$mediaName = $mediaRow[5];
		$desc = $mediaRow[6];
		$mediaid = $mediaRow[4];
	?>
	<tr>
	<td style="text-align:left;">
		<a href="media.php?id=<?php echo $mediaid;?>" target="_self"><?php echo $mediaName;?></a>
	</td>
	<td style="text-align:left"><?php echo $desc;?>
	</td>
</tr>
	<?php
	}?>
<br>
</table>


</body>
</html>
