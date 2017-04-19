

<?php

 
session_start();

include_once "function.php";

$username = $_POST['username'];
$mediaid = $_POST['mediaid'];
$comment = $_POST['comment'];



	$query = "insert into commentChains values (NULL,'$username', '$mediaid', NULL, '$comment')";

mysql_query( $query );

?>


<meta http-equiv="refresh" content="0;url=media.php?id=<?php echo $mediaid ?>">
