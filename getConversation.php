<?php
 
session_start();
include_once "function.php";


$username = $_SESSION['username'];
$recipient = $_POST['recipient'];

$query = "SELECT * FROM conversations WHERE 
    (user1='$username' AND user2='$recipient') OR (user2='$username' AND user1='$recipient')";

$result = mysql_query( $query );

if(!($conversation = mysql_fetch_row( $result ))){
    $insertQuery = "INSERT INTO conversations VALUES ('$username', '$recipient', NULL)"; 
    mysql_query( $insertQuery );
    $conversation = mysql_fetch_row(mysql_query( $query ));
}


?>
<meta http-equiv="refresh" content="0;url=conversation.php?id=<?php echo $conversation[2]?>#send">






