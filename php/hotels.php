<?php

$title = "AWESOME hotels";

require_once "core.php";
require_once "style/head.php";


$query = dbquery("SELECT * FROM hotels");
if(!dbrows($query)){ echo "Unfortunatly we do not have any hotels yet"; }
else{
$hotels = $query; //used later
?>

<h1>List of all hotels <small><a href="search.php">Search</a></small></h1>
<table class="table table-striped">
<tr><td>Hotel name</td><td>Location</td><td>Rooms</td><td>Lowest priced rooms</td><td>Highest priced rooms</td></tr>
<?php

while($hotel = dbarray($hotels))
{
	$rooms = dbquery("SELECT * FROM rooms WHERE `hotel_id` = '".$hotel['hotel_id']."'");
	echo "<tr><td><a href=\"hotel.php?id=".$hotel['hotel_id']."\">".$hotel['hotel_name']."</a></td><td>".$hotel['hotel_location']."</td><td>".dbrows($rooms)."</td><td>".$hotel['hotel_min_price']."</td><td>".$hotel['hotel_max_price']."</td></tr>";
}

?>
</table>

<?php
}
require_once "style/foot.php";

?>