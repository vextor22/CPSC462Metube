<?php

 
session_start();

include_once "function.php";
$playlist = $_GET['playlist'];
$id = $_GET['id'];

$query = "INSERT INTO playlistmedia VALUES (NULL, '$playlist', '$id')";

mysql_query($query);

?>

<meta http-equiv="refresh" content="0;url=media.php?id=<?php echo $id ?>">
