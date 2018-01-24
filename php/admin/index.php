<?php

$title = "Admin panel";

require_once "../core.php";

if(!isadmin()) die("Access denied");

require_once "../style/head.php";
?>

<div class="panel panel-default">
<div class="panel-heading">Admin panel</div>
<div class="panel-body">

	<h3>Adding</h3>
	<ol>
		<li><a href="add_user.php">Add user</a></li>
		<li><a href="add_hotel.php">Add hotel</a></li>
		<li><a href="add_room.php">Add room</a></li>
	</ol>
	
	<h3>Removing</h3>
	<ol>
		<li><a href="remove_user.php">Remove user</a></li>
		<li><a href="remove_hotel.php">Remove hotel</a></li>
		<li><a href="remove_room.php">Remove room</a></li>
		<li><a href="remove_booking.php">Remove booking</a></li>
	</ol>
	
	<h3>Other</h3>
	<ol>
		<li><a href="update_all.php">Update all</a></li>
	</ol>
	
</div>
</div>

<?php
require_once "../style/foot.php";
?>