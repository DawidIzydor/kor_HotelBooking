<?php

$title = "Add hotel";

require_once "../core.php";

if(!isadmin()) die("Access denied");

require_once "../style/head.php";

if(isset($_POST['submit']))
{
	
	if($_POST['hotel_name'] == "") {die("Hotel must have a name");}
	if($_POST['hotel_location'] == "") {die("Hotel must have a password");}
	
	$query = dbquery("INSERT INTO hotels (`hotel_name`, `hotel_location`)
						VALUES ('".$_POST['hotel_name']."','".$_POST['hotel_location']."' ) ")
?>

Added.

<?php

	
}else{
?>

<div class="panel panel-default">
	<div class="panel-heading">Add hotel</div>
	<div class="panel-body">
		<form action="add_hotel.php" method="post">
		
		<div class="form-group">
			<label for="hotel_name">Hotel name*</label>
			<input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="Hotel name" maxlength="255">
		</div>
		
		<div class="form-group">
			<label for="hotel_location">Hotel location*</label>
			<input type="text" class="form-control" id="hotel_location" name="hotel_location" placeholder="Location" maxlength="255">
		</div>
		
		<div>* - required</div>
		
		<button type="submit" name="submit" class="btn btn-default">Submit</button>
		
		</form>
	</div>
</div>


<?php
}



require_once "../style/foot.php";
?>