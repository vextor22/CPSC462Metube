<?php

 
session_start();

include_once "function.php";
$id = $_GET['id'];
$query = "DELETE playlist FROM playlist WHERE playlistid='$id'";

mysql_query($query);


?>

<meta http-equiv="refresh" content="0;url=playlists.php">
