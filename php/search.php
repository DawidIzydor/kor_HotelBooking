<?php

$title = "Search room";

require_once "core.php";
require_once "style/head.php";

if(isset($_POST['submit']))
{
	
	$pars = "";
	
	if(isset($_POST['search_location']) && $_POST['search_location'] != "")
	{
		$pars = $pars."h.hotel_location = '".$_POST['search_location']."'";
	}
	
	if(isset($_POST['search_lowest_price']) && $_POST['search_lowest_price'] != "")
	{
		if($pars != "") $pars = $pars." AND ";
		$pars = $pars."r.room_price >= '".$_POST['search_lowest_price']."'";
	}
	
	if(isset($_POST['search_highest_price']) && $_POST['search_highest_price'] != "")
	{
		if($pars != "") $pars = $pars." AND ";
		$pars = $pars."r.room_price <= '".$_POST['search_highest_price']."'";
	}
	
	if(isset($_POST['search_lowest_cap']) && $_POST['search_lowest_cap'] != "")
	{
		if($pars != "") $pars = $pars." AND ";
		$pars = $pars."r.room_capacity >= '".$_POST['search_lowest_cap']."'";
	}
	
	if(isset($_POST['search_highest_cap']) && $_POST['search_highest_cap'] != "")
	{
		if($pars != "") $pars = $pars." AND ";
		$pars = $pars."h.room_capacity <= '".$_POST['search_highest_cap']."'";
	}
	
	if(isset($_POST['search_onlycomm']) && $_POST['search_onlycomm'] != "")
	{
		if($pars != "") $pars = $pars." AND ";
		$pars = $pars."r.room_user_status_req = '2'";
	}
	
	/*if(isset($_GET['search_start_date']) && $_GET['search_start_date'] != "")
	{
		if($pars != "") $pars = $pars." AND ";
		$pars = $pars.$_GET['search_start_date']." NOT BETWEEN b.start_date AND b.end_date";
	}*/
	
	$rooms = dbquery("SELECT * FROM `rooms` AS r
		LEFT JOIN `hotels` AS h 
		ON r.hotel_id = h.hotel_id

		".($pars != "" ? "WHERE ".$pars : "")." ORDER BY h.hotel_name ASC, r.room_id ASC");
		
	if(dbrows($rooms))
	{
?>
<table class="table table-striped">
<tr><td>Room id</td><td>Hotel name</td><td>Price<td>Capacity </td><td>Only commercial?</td><td></td></tr>
<?php

		while($room = dbarray($rooms))
		{
			if(isset($_POST['search_start_date']) && $_POST['search_start_date'] != "")
			{
				$startdate = strtotime($_POST['search_start_date']);
				$query = dbquery("SELECT * FROM bookings WHERE `room_id` = '".$room['room_id']."' AND `booking_start_date` <= '$startdate' AND `booking_end_date` >= '$startdate' ");
				if(dbrows($query))
				{
					continue;
				}
				
			}
			
			if(isset($_POST['search_end_date']) && $_POST['search_end_date'] != "")
			{
				$enddate = strtotime($_POST['search_end_date']);
				$query = dbquery("SELECT * FROM bookings WHERE `room_id` = '".$room['room_id']."' AND `booking_start_date` <= '$enddate' AND `booking_end_date` >= '$enddate' ");
				if(dbrows($query))
				{
					continue;
				}
				
			}
			
			echo "<tr><td>".$room['room_id']."</td><td>".$room['hotel_name']."</td><td>".$room['room_price']."</td><td>".$room['room_capacity']."</td><td>".($room['room_user_status_req'] == 2? "Commercial" : "")."</td><td>";
			echo "<a href=\"book_room.php?id=".$room['room_id']."\" class=\"btn btn-primary\"> Book it!</a>";
			echo "</td></tr>\n";
		}
		echo "</table>\n";
	}else{

?>
No hotels found matching your cryterias.

<?php
	}
?>

<a href="search.php" class="btn btn-primary btn-lg">Do another search</a>

<?php
}else{
?>

<div class="panel panel-default">
	<div class="panel-heading">Search room</div>
	<div class="panel-body">
	
		<form action="search.php" method="post">
		
		Leave box blank for any.
		
		<div class="form-group">
			<label for="search_location">Location</label>
			<input type="text" class="form-control" id="search_location" name="search_location" placeholder="Location">
		</div>
		
		<div class="form-group">
			<label for="search_start_date">From date</label>
			<input type="date" class="form-control" id="search_start_date" name="search_start_date" placeholder="DD-MM-YYYY">
		</div>
		
		<div class="form-group">
			<label for="search_end_date">To date</label>
			<input type="date" class="form-control" id="search_end_date" name="search_end_date" placeholder="DD-MM-YYYY">
		</div>
		
		<div class="form-group">
			<label for="search_lowest_price">Price from</label>
			<input type="number" class="form-control" id="search_lowest_price" name="search_lowest_price" placeholder="From price">
		</div>
		
		<div class="form-group">
			<label for="search_highest_price">Price to</label>
			<input type="number" class="form-control" id="search_highest_price" name="search_highest_price" placeholder="To price">
		</div>
		
		<div class="form-group">
			<label for="search_lowest_cap">Capacity from</label>
			<input type="number" class="form-control" id="search_lowest_cap" name="search_lowest_cap" placeholder="From capacity">
		</div>
		
		<div class="form-group">
			<label for="search_highest_cap">Capacity to</label>
			<input type="number" class="form-control" id="search_highest_cap" name="search_highest_cap" placeholder="To capacity">
		</div>
		
		<div class="checkbox">
			<label><input type="checkbox" name="search_onlycomm"> Only commercials</label>
		</div>
		
		
		<button type="submit" name="submit" class="btn btn-default">Submit</button>
		
		</form>
	</div>
</div>

<?php
}

require_once "style/foot.php";
?>