
<?php

 
session_start();

include_once "function.php";
$title = $_GET['title'];
$newTitle = $_GET['ptitle'];
$id = $_GET['id'];
$username = $_SESSION['username'];

$checkQuery = "SELECT * FROM playlist WHERE title='$title' AND username='$username'";
$result = mysql_query( $checkQuery );
$row_result = mysql_fetch_row( $result );

if(isset($row_result)){

    $playlist = $row_result[0];
    ?>

<?php
}

if($title == "newPlaylist"){
$title = $newTitle;
$query = "INSERT INTO playlist VALUES (NULL, '$title', '$username')";

mysql_query($query);

$query = "SELECT * FROM playlist WHERE title='$title' AND username='$username'";

$result = mysql_query( $query );

$row_result= mysql_fetch_row( $result);

$playlist = $row_result[0];

?>


<?php
} ?>


 <meta http-equiv="refresh" content="0;url=addToPlaylist.php?id=<?php 
    echo $id."&playlist=".$playlist; ?>">
