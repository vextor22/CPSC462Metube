<html>

<head>
<title>Conversation</title>
<?php
 
session_start();
include_once "function.php";
include_once "nav-bar.php";
?>
</head>

<body>
<h3>Messages</h3>
<hr />
<div class="centerer">

    <div style="text-align: left; display: inline-block">
<?php
$conversationID = $_GET['id'];


$query = "SELECT * from messages WHERE conversationID=$conversationID";

$result = mysql_query( $query );

while($row_result = mysql_fetch_row($result)){
    $sender = $row_result[4];
    $time = $row_result[2];
    $message = $row_result[3];
    if($row_result[4] == $_SESSION['username']){    
?>
    <div class="messageBox outgoing">
    <?php
    } else {?>
    <div class="messageBox">
    <?php } ?>

            <p class="left"> <?php echo "$sender" ?></p>
            <p class="right"><?php echo $time ?> </p>

            <div class="clear"></div>
<?php
    echo "<p>".$message."</p>";
    echo "</div>";
}

?>

<hr />

<form action="sendMessage.php" method="post">
    <textarea style="min-width: 500px;" class="form-control" rows="3"  name="message" placeholder="Send a message!"></textarea>
    <input type="hidden" name="conversationID" value="<?php echo $conversationID; ?>">
    <input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>">
    <button type="submit" id="send" class="btn btn-default">Send Message</button>
</form>
</div>
</div>
</body>

</html>
