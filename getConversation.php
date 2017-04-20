<?php
 
session_start();
include_once "function.php";

echo $_POST['recipient'];
echo "<br>";
echo $_SESSION['username'];

$username = $_SESSION['username'];
$recipient = $_POST['recipient'];

$query = "SELECT * FROM conversations WHERE 
    (user1='$username' AND user2='$recipient') OR (user2='$username' AND user1='$recipient')";

$result = mysql_query( $query );

if(!($conversation = mysql_fetch_row( $result ))){
    echo "<br> In loop! <br>";
    echo mysql_error()."<br>";
    echo $conversation;   
    $insertQuery = "INSERT INTO conversations VALUES ('$username', '$recipient', NULL)"; 
    mysql_query( $insertQuery );
    echo mysql_error()."<br>";
    $conversation = mysql_fetch_row(mysql_query( $query ));
}

echo "<br> post loop! <br>";
echo $conversation[2];

?>
<meta http-equiv="refresh" content="0;url=conversation.php?id=<?php echo $conversation[2]?>">






