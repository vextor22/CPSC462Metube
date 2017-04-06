<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include('nav-bar.php') ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Upload</title>

<style> 

input, textarea{
    padding: 12px 20px;
    margin: 8px 0;
}

#centerer {
 text-align: center;   
}

form {
    display: inline-block;
    text-align: left;
}
</style>

</head>

<body>

<div id="centerer">

<form method="post" action="media_upload_process.php" enctype="multipart/form-data" >
 
  <p style="margin:0; padding:0">
  <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
   Add a Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
   <input  name="file" type="file" size="50" />
    <br>

    <label for="title">Title</label>
    <br>
    <input id="title" name="title" type="text" />
    <br>
    <label for="description">Description</label><br>
    <textarea name="description"  id="description" rows="10" cols="80" placeholder="Enter Description here..."></textarea> 
    <br>

    <label for="keywords">Keywords</label><br>
    <input name="keywords" id="keywords" type="text" />
    <br>
	<input value="Upload" name="submit" type="submit" />
  </p>
 
                
 </form>
</div>
</body>
</html>
