
<html>
<head>
	<title>Playlists</title>
	<script type="text/javascript" src"js/jquery-latest.parck.js"> </script>

	<?php
		session_start();
		include_once "function.php";
		include('nav-bar.php');
?>
</head>

<body>

<?php
$user = $_SESSION['username'];

$query = "SELECT * FROM playlist WHERE username='$user'";

$result = mysql_query( $query );
?>

		<div style="text-align:center; font-size:24px">
			<?php echo $user;?>'s Playlists
            <hr />
		</div>


<div class="centerer">
    <div style="text-align: center; display: inline-block; width: 80%;">
<?php
while($row_result = mysql_fetch_row( $result)){
    $playlistTitle = $row_result[1];
    $playlistID = $row_result[0];
?>
<div style="max-width: 700px; margin: auto;">
    <p class="left"><a href="playlist.php?id=<?php echo $playlistID ?>"><?php echo $playlistTitle;?></a></p> 
    <p class="right"><a href="deletePlaylist.php?id=<?php echo $playlistID ?>">Delete Playlist</a></p>
    
            <div class="clear"></div>
</div>
<?php  
}



?>

</div>
</div>
</body>

</html>