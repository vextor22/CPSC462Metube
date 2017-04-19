<head>
	<title>Favorites Page</title>
</head>

<html>
<body>
<?php
session_start();
include_once "function.php";
include('nav-bar.php');

$username = $_SESSION['username'];

#get users favorites list
$favQuery = "SELECT * FROM favorites WHERE username='$username'";
$favResult = mysql_query($favQuery);
?>
<div style="text-align:center;">Favorites List</div>
<table width="50%" class="table table-hover">
	<?php
	while($favRow = mysql_fetch_row($favResult)){
		#get the media title and id
		$mediaid = $favRow[2];
		//filename username type mediaid path title desc keyworks favid
		$mediaQuery = "SELECT * FROM media JOIN favorites WHERE favorites.mediaid='$mediaid' AND media.mediaid='$mediaid'";
		$mediaResult = mysql_query($mediaQuery)
			or die("Could not find specified media.".mysql_error());
		$mediaRow = mysql_fetch_row($mediaResult);
		$mediaName = $mediaRow[5];
	?>
	<tr>
	<td style="text-align:center">
		<a href="media.php?id=<?php echo $mediaid;?>" target="_self"><?php echo $mediaName;?></a>
	</td>
	<td align="right">
		<a href="deletefav.php?id=<?php echo $mediaid;?>">Delete </a>
	</td>
	</tr>
	<?php
	}?>
</table>
</body>
<html>

