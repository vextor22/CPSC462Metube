<head>
	<title>Media Categories</title>
	<script type="text/javascript" src"js/jquery-latest.parck.js"> </script>
</head>

<html>
<body>
	<?php
		session_start();
		include_once "function.php";
		include('nav-bar.php');

		$query = "SELECT DISTINCT(type) FROM media";
		$result = mysql_query( $query );
		
	?>

	<table style="table-layout:fixed;" class="table table-hover">

	<?php

	$i = 0;
	$maxCols = 5;
	while ($result_row = mysql_fetch_row($result)) {
		
		$fileType = $result_row[0];
	
		if ($i % $maxCols == 0) { ?>	
		<tr><?php 
		}
		$i = ($i+1) % $maxCols;
		?>

		<form method="post" id="catForm<?php echo $fileType;?>" action="user_profile.php">
			<input type="hidden" name="category" value="<?php echo $fileType; ?>" />
		</form>
		<td style="text-align:center">
			<a style="cursor:pointer; cursor:hand;"  onclick="javascript:document.getElementById('catForm<?php echo $fileType?>').submit();"><?php echo $fileType;?></a>
		</td>
		<?php if ($i % $maxCols == 0) { ?>
		</tr>
		<?php
		} ?>
	<?php
	} ?>
	</br>	
	</table>
</body>
</html>
