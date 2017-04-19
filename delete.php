<?php
session_start();
include_once "function.php";

/******************************************************
 *
 * Delete User's file
*
*******************************************************/

$username=$_SESSION['username'];


$mediaID = $_GET['id'];

$query = "select * from media where mediaid='$mediaID'";


$result = mysql_query( $query );
if($result){
$deletePath = mysql_fetch_row($result)[4];
//unlink($deletePath);
echo "Hello";
$query = "DELETE media, favorites, playlistmedia, channelmedia FROM media LEFT JOIN favorites ON media.mediaid = favorites.mediaid
        LEFT JOIN playlistmedia  ON media.mediaid = playlistmedia.mediaid
        LEFT JOIN channelmedia ON media.mediaid = channelmedia.mediaid WHERE media.mediaid=$mediaID";
//$query = "DELETE media, favorites FROM media LEFT JOIN favorites ON media.mediaid = favorites.mediaid WHERE media.mediaid=$mediaID";
mysql_query( $query );
//echo mysql_fetch_row(mysql_query( $query))[0];
}
?>
<meta http-equiv="refresh" content="0;url=profile.php">
