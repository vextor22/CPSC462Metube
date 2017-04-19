
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
    include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Conetent-Language" content="en">
<title>Media browse</title>

<script type="text/javascript">
function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message) 
    { }
 	);
} 
</script>


<?php include('nav-bar.php') ?>
</head>

<body>

<?php
    $searchWords = explode(" ", $_POST["keyword"]);
	$query = "SELECT * from media where keywords RLIKE '$searchWords[0]"; 
    for($i = 1; $i < count($searchWords); $i++){
        $query .= "|$searchWords[$i]"; 
    }
    $query .= "'";
	$result = mysql_query( $query );
	if (!$result){
	   die ("No results found $query");
	}
?>
    
        <div style="background:#339900;color:#FFFFFF; width:150px;">Media found similar to: <?php echo $_POST["keyword"]; ?></div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
			while ($result_row = mysql_fetch_row($result)) //filename, username, type, mediaid, path
			{ 
				$mediaid = $result_row[3];
				$filename = $result_row[0];
                $filenpath = $result_row[4];
                $title = $result_row[5];
                if(strlen($title) == 0){
                    $title = $filename;
                }
		?>
        	 <tr valign="top">			
			<td>
					<?php 
						echo $mediaid;  //mediaid
					?>
			</td>
                        <td>
            	            <a href="media.php?id=<?php echo $mediaid;?>" target="_self"><?php echo $title;?></a> 
                        </td>
                        <td>
            	            <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
                        </td>
		</tr>
        	<?php
			}
		?>
	</table>
   </div>
</body>
</html>
