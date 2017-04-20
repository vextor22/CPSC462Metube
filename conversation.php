<html>

<head>

<?php
 
session_start();
include_once "function.php";
include_once "nav-bar.php";
?>
</head>

<body>
<?php
$conversationID = $_GET['id'];


$query = "SELECT * from messages WHERE conversationID=$conversationID";

$result = mysql_query( $query );

while($row_result = mysql_fetch_row($result)){
    if($row_result[4] == $_SESSION['username']){    
?>
    <div class="messageBox outgoing">
    <?php
    } else {?>
    <div class="messageBox">
    <?php }
    echo $row_result[3];
    echo "</div>";
}

?>

<hr />

<form action="sendMessage.php" method="post">
    <textarea style="min-width: 500px;" class="form-control" rows="3"  name="message" placeholder="Send a message!"></textarea>
    <input type="hidden" name="conversationID" value="<?php echo $conversationID; ?>">
    <input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>">
    <button type="submit" class="btn btn-default">Send Message</button>
</form>
</body>

</html>
