<?php

$title = "Hotel info";

require_once "core.php";
require_once "style/head.php";


$query = dbquery("SELECT * FROM hotels WHERE `hotel_id` = '".$_GET['id']."'");
if(!dbrows($query)){ echo "Unfortunatly there is no hotel with this id"; }
else{
$hotel = dbarray($query); //used later
?>

<div class="page-header">
	<h1><?php echo $hotel['hotel_name']." <small>".$hotel['hotel_location']."</small>"; ?> </h1>
</div>

<h3>Number of rooms: <?php echo $hotel['hotel_rooms']; ?></h3>

<table class="table table-striped">
<tr><td>Room id</td><td>Room capacity</td><td>Room price</td><td>Only commercial</td><td></td></tr>
<?php
$query = dbquery("SELECT * FROM rooms WHERE `hotel_id` = '".$hotel['hotel_id']."' ORDER BY `room_price` DESC");

while($room = dbarray($query))
{
	echo "<tr><td>".$room['room_id']."</td><td>".$room['room_capacity']."</td><td>".$room['room_price']."</td><td>".($room['room_user_status_req'] == 2 ? "Commercial" : "")."</td>
	<td>";
	
	$endq = dbquery("SELECT `booking_end_date` FROM bookings WHERE `booking_start_date`<'".time()."' AND `booking_end_date` > '".time()."' AND `room_id` = '".$room['room_id']."'");
	
	if(!$commercial && $room['room_user_status_req']==2)
	{
		echo "<button type=\"button\" class=\"btn btn-warning\"> You are not commercial</a>";
	}elseif(dbrows($endq)){
		echo "<button type=\"button\" class=\"btn btn-danger\"> Room booked</a>";
	}
	else{
		echo "<a href=\"book_room.php?id=".$room['room_id']."\" class=\"btn btn-primary\"> Room avaible - book it!</a>";
	}
	echo "</td></tr>\n";
}

?>
</table>

<?php
}
require_once "style/foot.php";

?>