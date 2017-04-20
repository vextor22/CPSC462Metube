


<?php

 
session_start();

include_once "function.php";
$playlist = $_GET['playlist'];
$id = $_GET['id'];

$query = "DELETE playlistmedia FROM playlistmedia WHERE idkey='$id'";

mysql_query($query);

?>

<meta http-equiv="refresh" content="0;url=playlist.php?id=<?php echo $playlist ?>">
