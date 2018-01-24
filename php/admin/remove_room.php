<?php

$title = "Remove room";

require_once "../core.php";

if(!isadmin()) die("Access denied");

require_once "../style/head.php";

$rooms = dbquery("SELECT * FROM `rooms` AS r
					LEFT JOIN `hotels` AS h 
					ON r.hotel_id = h.hotel_id");

if(isset($_POST['submit']))
{
	if(isset($_POST['room_id'])){

		$query = dbquery("DELETE FROM rooms WHERE `room_id` = '".$_POST['room_id']."' LIMIT 1");
		$query = dbquery("DELETE FROM bookings WHERE `room_id` = '".$_POST['room_id']."'");
		
	}
	
?>

Removed.

<?php

	
}else{
?>

<div class="panel panel-default">
	<div class="panel-heading">Remove room</div>
	<div class="panel-body">
		<form action="remove_room.php" method="post">
		
		<div class="form-group">
			<label for="room_id">Choose room</label>
			<select name="room_id" class="form-control">
<?php

	while($room = dbarray($rooms))
	{
		if($room['room_name'] == "admin") continue;
		echo '<option value="'.$room['room_id'].'">'.$room['hotel_name'].' - '.$room['room_id'].'</option>';
	}

?>
			</select>
		</div>
		
		
		<button type="submit" name="submit" class="btn btn-default">Submit</button>
		
		</form>
	</div>
</div>


<?php
}



require_once "../style/foot.php";
?>