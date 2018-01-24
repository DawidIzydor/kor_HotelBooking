<?php

$title = "Book room";

require_once "core.php";
require_once "style/head.php";

if(!$logged) die("You must be logged in");

$query = dbquery("SELECT `room_id` FROM rooms WHERE `room_id` = '".$_GET['id']."'");
if(!dbrows($query)) die("Room id not found");

?>
<div class="panel panel-default">
<?php
if(isset($_POST['submit']))
{
	
	if($_POST['book_start_date'] == "") {die("You must precise start date");}
	if($_POST['book_end_date'] == "") {die("You must precise end date");}
	
	$startdate = strtotime($_POST['book_start_date']);
	$enddate = strtotime($_POST['book_end_date']);
	
	$query = dbquery("SELECT `booking_end_date` FROM `bookings` WHERE `booking_start_date` <= $startdate AND `booking_end_date` >= $enddate");
	if(dbrows($query))
	{
		?>
		<div class="alert alert-warning" role="alert">This room is already booked for that date</div>
		<?php
		goto forms;
	}else{
	
		$query = dbquery("INSERT INTO bookings (`room_id`, `booking_start_date`, `booking_end_date`, `user_id`) VALUES ('".$_GET['id']."', '$startdate', '$enddate', '$userid')");

?>

Booked.

<?php
	}
	
}else{

	forms:
?>


	<div class="panel-heading">Book room</div>
	<div class="panel-body">
	
		<form action="book_room.php?id=<?php echo $_GET['id'];?>" method="post">
		
		<div class="form-group">
			<label for="book_start_date">From date</label>
			<input type="date" class="form-control" id="book_start_date" name="book_start_date" placeholder="DD-MM-YYYY">
		</div>
		
		<div class="form-group">
			<label for="book_end_date">To date</label>
			<input type="date" class="form-control" id="book_end_date" name="book_end_date" placeholder="DD-MM-YYYY">
		</div>
		
		
		<div class="checkbox">
			<label><input type="checkbox" name="room_onlycomm"> I will pay</label>
		</div>
		
		<button type="submit" name="submit" class="btn btn-default">Submit</button>
		
		</form>
	</div>
</div>

<?php
}

require_once "style/foot.php";
?>