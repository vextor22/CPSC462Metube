<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>


<link href="http://vjs.zencdn.net/5.19.1/video-js.css" rel="stylesheet">

  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

<?php include('nav-bar.php') ?>
<link rel="stylesheet" href="css/default.css">
</head>

<body>
<?php
	#stuff for favorites
	if (isset($_POST['fav'])){
		#check to make sure you already not favourited
		$username = $_SESSION['username'];
		$query = "SELECT * FROM favorites WHERE mediaid='".$_GET['id']."' AND username='$username'";

		$checkQuery = mysql_query($query);
		$checkRow = mysql_fetch_row($checkQuery);
		if($checkRow == NULL){
			$query = "INSERT INTO favorites VALUES(NULL, '$username', '".$_GET['id']."')";
			$postResult = mysql_query($query)
				or die("Could not add favorite".mysql_error());
		}
		else {
			echo "This is already a favorite!";
		}
	}
?>

<?php
if(isset($_GET['id'])) {
	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);
	
	//updateMediaTime($_GET['id']);
	$mediaID = $_GET['id'];
	$filename=$result_row[0];   ////0, 4, 2
	$filepath=$result_row[4]; 
	$type=$result_row[2];
    $title = $result_row[5];
    ?>
    <div class="centerer">
    <div style="text-align: left; display: inline-block">

    <div class="mediaWrapper">

        <h3><?php echo $title; ?></h3>
<?php
	if(substr($type,0,5)=="image") //view image
	{
		echo "<img src='".$filepath."'/>";
	}
	else //view movie
	{	
?>
	      

<video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
   data-setup="{}">
   <source src="<?php echo $result_row[4];?>" type='<?php echo $type;?>'>
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a web browser that
      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
  </video>

  <script src="http://vjs.zencdn.net/5.19.1/video.js"></script>  
<?php
	}
}
else
{
?>
<meta http-equiv="refresh" content="0;url=browse.php">
<?php
}
?>
</div>
<br>
  <form id="favs" method="post">
	<input name="fav" type="submit" value="Favorite">
  </form> 

    <?php
        $query = "SELECT * FROM commentChains WHERE mediaID=$mediaID ORDER BY time DESC";
         
        $result = mysql_query( $query );?>
        <h3>Comments: </h3> 

        <form action="addComment.php" method="post">
                <textarea class="form-control" rows="3"  name="comment" placeholder="Place a comment!"></textarea>
            <input type="hidden" name="mediaid" value="<?php echo $mediaID; ?>">
            <input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>">
            <button type="submit" class="btn btn-default"> Submit </button>
        </form>
        <hr />
        <?php
        while($result_row = mysql_fetch_row($result)){
            $username = $result_row[1];
            $comment = $result_row[4];
            $time = $result_row[3];

            $userInfoQuery = "SELECT * FROM account WHERE username='$username'";
            $userResult = mysql_query($userInfoQuery);
            $userInfo = mysql_fetch_row($userResult);
            $userFName = $userInfo[2];
            $userLName = $userInfo[3];
            ?>
            <div class="commentBox">
            <p class="left"> <?php echo "$userFName $userLName" ?></p>
            <p class="right"><?php echo $time ?> </p>
            <div class="clear"></div>
            <?php echo "<p>".$result_row[4]."</p>";?>

            </div>
        <?php
        } 




    ?>          
</div>
</div>
</body>
</html>
