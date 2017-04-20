

<html>
<head>
	<title>Your Playlist</title>
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
$id = $_GET['id'];

$query = "SELECT * FROM playlistmedia WHERE playlistid='$id'";

$result = mysql_query( $query );
?>

		<div style="text-align:center; font-size:24px">
			<?php echo $user;?>'s Playlist
            <hr />
		</div>


<div class="centerer">
    <div style="text-align: center; display: inline-block; width: 80%;">
<?php
while($row_result = mysql_fetch_row( $result)){
    $mediaid = $row_result[2];
    $idkey = $row_result[0];
    $mediaQuery = "SELECT * FROM media WHERE mediaid='$mediaid'";
    $mediaresult = mysql_fetch_row(mysql_query( $mediaQuery ));
    
    $title = $mediaresult[7];
?>
<div style="max-width: 700px; margin: auto;">
    <p class="left"><a href="media.php?id=<?php echo $mediaid ?>"><?php echo $title;?></a></p> 
    <p class="right"><a href="deleteFromPlaylist.php?id=<?php echo $idkey."&playlist=".$id ?>">Delete From Playlist</a></p>
    
            <div class="clear"></div>
</div>
<?php  
}



?>

</div>
</div>
</body>

</html>
