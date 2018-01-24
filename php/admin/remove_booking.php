<?php

$title = "Remove room";

require_once "../core.php";

if(!isadmin() && !ismayor()) die("Access denied");

require_once "../style/head.php";

$rooms = dbquery("SELECT * FROM `rooms` AS r
					LEFT JOIN `hotels` AS h 
					ON r.hotel_id = h.hotel_id");
?><div class="panel panel-default"><?php

if(isset($_POST['end_submit']))
{
	if(isset($_POST['data'])){
		
		$roomid = explode(",", $_POST['data'])[0];
		$bookid = explode(",", $_POST['data'])[1];
		
		$query = dbquery("DELETE FROM bookings WHERE `booking_id` = '$bookid' AND `room_id` = '$roomid' LIMIT 1");
		
	}
	
?>

Removed.

<?php
}elseif(isset($_POST['submit'])){
	
	$query = dbquery("SELECT * FROM bookings WHERE `room_id` = '".$_POST['room_id']."'");
?>

	<div class="panel-heading">Remove booking</div>
	<div class="panel-body">
		<form action="remove_booking.php" method="post">
		
		<div class="form-group">
			<label for="data">Choose booking</label>
			<select name="data" class="form-control">
			
<?php

	while($booking = dbarray($query))
	{
		if($booking['room_name'] == "admin") continue;
		echo '<option value="'.$booking['room_id'].','.$booking['booking_id'].'">'.date("d-m-Y", $booking['booking_start_date']).' - '.date("d-m-Y", $booking['booking_end_date']).'</option>';
	}

?>
			</select>
		</div>
		
		
		<button type="submit" name="end_submit" class="btn btn-default">Submit</button>
		
		</form>
	</div>
</div>
<?php
}else{
?>


	<div class="panel-heading">Remove booking</div>
	<div class="panel-body">
		<form action="remove_booking.php" method="post">
		
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
?></div><?php


require_once "../style/foot.php";
?>