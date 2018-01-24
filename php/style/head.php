<?php if(!defined("BASE")) die("Acc denied"); 

$user; $userid; $username; $userlevel; $logged = false; $commercial = false;
if(isset($_COOKIE['HOTEL_MAN_USER'])){
	$cookiedata = explode(",", $_COOKIE['HOTEL_MAN_USER']);

	$query = dbquery("SELECT * FROM users WHERE `user_id` = '".$cookiedata[0]."' AND `user_pass` = '".$cookiedata[1]."' AND `user_deleted` != '1' ");
	if(dbrows($query))
	{
		$user = dbarray($query);
		$userid = $user['user_id'];
		$username = $user['user_name'];
		$userlevel = $user['user_level'];
		$logged = true;
		$commercial = ($user['user_status'] == 2 ? true : false);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php global $title; echo $title; ?></title>
	<link rel="stylesheet" href="<?php echo BASE; ?>style/maincss.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASE; ?>style/bootstrap.css" type="text/css" />
	
	<script type="text/javascript" src="<?php echo BASE; ?>scripts/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE; ?>scripts/mainjs.js"></script>
	<script type="text/javascript" src="<?php echo BASE; ?>scripts/bootstrap.js"></script>
	
</head>

<body>

<div class="logo"><a href="<?php echo BASE; ?>">Profesional Hotel Management</a></div>


<nav class="navbar navbar-default">
	<div class="navbar-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		</div>
		
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo BASE; ?>index.php">Home page</a></li>
				<li><a href="<?php echo BASE; ?>hotels.php">List of hotels</a></li>
				<li><a href="<?php echo BASE; ?>search.php">Search</a></li>
<?php
if(!$logged){
?>
				<li><a href="<?php echo BASE; ?>login.php">Login</a></li>
<?php
}
?>
			</ul>
<?php

if($logged){ // Logged in user right top nav panel
?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo BASE; ?>profile.php">Welcome <?php echo $username; ?></a></li>
<?php
		if($userlevel > 90){
?>
				<li><a href="<?php echo BASE; ?>admin/">Admin panel</a></li>
<?php
		}elseif($userlevel > 9){
?>
				<li><a href="<?php echo BASE; ?>admin/remove_booking.php">Mayor panel</a></li>
<?php
		}
?>
				<li><a href="<?php echo BASE; ?>logout.php">Logout</a></li>
			</ul>
<?php
}	// end of Logged in user right top nav panel


?>
		</div>
	</div> <!-- /navbar-fluid -->
</nav>

<div class="content">