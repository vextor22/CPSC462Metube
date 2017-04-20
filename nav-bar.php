
<link rel="stylesheet" href="css/bootstrap.min.css" >
<link rel="stylesheet" href="css/default.css">
<script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>

<?php
	include_once "function.php";
	
	if (isset($_SESSION['username'])) {
		$loggedIn = 1;	
	}

	#nav bar will be different if a user is logged in
	if (isset($loggedIn)) { ?>
	
<nav class="navbar navbar-default">
 <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="browse.php">MeTube</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="categories.php">Categories<span class="sr-only">(current)</span></a></li>
       	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Media<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="channels.php">Your Channels</a></li>
            <li><a href="subscriptions.php">Subscriptions</a></li>
	    <li><a href="favorites.php">Favorites</a></li>
	    <li><a href="media_upload.php">Upload Media</a></li>
          </ul>
       </li>
<li><a href="users.php">Users</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profile<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="profile.php">View Profile</a></li>
            <li><a href="profile_update.php">Update Profile</a></li>
          </ul>
        </li>
      </ul>
      <form method="post" action="search.php" enctype="multipart/form-data" class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" name="keyword" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default" >Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>
	<?php
	}

	else { ?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="browse.php">MeTube</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="categories.php">Categories<span class="sr-only">(current)</span></a></li>
       	<li><a href="users.php">Users</a></li>
        <li class="dropdown">
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Sign In</a></li>
      </ul>
	<ul class="nav navbar-nav navbar-right">
        <li><a href="register.php">Register</a></li>
      </ul>
    </div>
  </div>
</nav>

	<?php } ?>
