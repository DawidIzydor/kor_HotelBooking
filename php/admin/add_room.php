<?php

$title = "Add room";

require_once "../core.php";

if(!isadmin()) die("Access denied");

require_once "../style/head.php";

$query = dbquery("SELECT * FROM hotels");
if(dbrows($query)){
$hotels = $query; // used later

if(isset($_POST['submit']))
{
	
	if($_POST['room_capacity'] == "") {die("Room must have capacity");}
	if($_POST['room_price'] == "") {die("User must have a price");}
	
	$query = dbquery("INSERT INTO rooms (`hotel_id`, `room_capacity`, `room_price`, `room_user_status_req`)
						VALUES ('".$_POST['room_hotel']."','".$_POST['room_capacity']."' ,'".$_POST['room_price']."' ,'".(isset($_POST['room_onlycomm']) ? "2":"1")."' ) ");
	updatehotelinfo($_POST['room_hotel']);
?>

Added.

<?php

	
}else{
?>

<div class="panel panel-default">
	<div class="panel-heading">Add room</div>
	<div class="panel-body">
		<form action="add_room.php" method="post">
		
		<div class="form-group">
			<label for="room_hotel">Choose hotel</label>
			<select name="room_hotel" class="form-control">
<?php

	while($hotel = dbarray($hotels))
	{
		echo '<option value="'.$hotel['hotel_id'].'">'.$hotel['hotel_name'].'</option>';
	}

?>
			</select>
		</div>
		<div class="form-group">
			<label for="room_capacity">Room capacity*</label>
			<input type="number" class="form-control" id="room_capacity" name="room_capacity" placeholder="Capacity" maxlength="8">
		</div>
		
		<div class="form-group">
			<label for="room_price">Room price*</label>
			<input type="number" class="form-control" id="room_price" name="room_price" placeholder="Price" maxlength="8">
		</div>
		
		<div class="checkbox">
			<label><input type="checkbox" name="room_onlycomm"> Only commercial</label>
		</div>
  
		
		
		<div>* - required</div>
		
		<button type="submit" name="submit" class="btn btn-default">Submit</button>
		
		</form>
	</div>
</div>


<?php
}

}else{
?>
	You must first add at least one hotel.<br /><a href="add_hotel.php">Add hotel</a>
<?php
}


require_once "../style/foot.php";
?>