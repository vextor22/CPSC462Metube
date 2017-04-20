<?php

session_start();
include_once "function.php";

$conversationID = $_POST['conversationID'];
$message = $_POST['message'];
$sender = $_SESSION['username'];

$query = "INSERT INTO messages VALUES (NULL, $conversationID, NULL, '$message', '$sender')";
mysql_query( $query );
?>

<meta http-equiv="refresh" content="0;url=conversation.php?id=<?php echo $conversationID ?>">
