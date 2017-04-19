<?php
session_start();
include_once "function.php";

$username = $_SESSION['username'];
$mediaid = $_GET['id'];

$query = "DELETE FROM favorites WHERE username='$username' AND mediaid='$mediaid'";

$result = mysql_query($query)
	or die ("Could not remove favorite.".mysql_error());
?>
<meta http-equiv="refresh" content="0;url=favorites.php">
