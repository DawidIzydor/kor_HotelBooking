<?php

$title = "Remove hotel";

require_once "../core.php";

if(!isadmin()) die("Access denied");

require_once "../style/head.php";

$hotels = dbquery("SELECT * FROM `hotels`");

if(isset($_POST['submit']))
{
	if(isset($_POST['hotel_id'])){

		$query = dbquery("DELETE FROM hotels WHERE `hotel_id` = '".$_POST['hotel_id']."' LIMIT 1");
		$query = dbquery("DELETE FROM rooms WHERE `hotel_id` = '".$_POST['hotel_id']."'");
	}
	
?>

Removed.

<?php

	
}else{
?>

<div class="panel panel-default">
	<div class="panel-heading">Remove hotel</div>
	<div class="panel-body">
		<form action="remove_hotel.php" method="post">
		
		<div class="form-group">
			<label for="hotel_id">Choose hotel</label>
			<select name="hotel_id" class="form-control">
<?php

	while($hotel = dbarray($hotels))
	{
		if($hotel['hotel_name'] == "admin") continue;
		echo '<option value="'.$hotel['hotel_id'].'">'.$hotel['hotel_name'].'</option>';
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