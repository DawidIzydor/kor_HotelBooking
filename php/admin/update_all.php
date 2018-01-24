<?php

$title = "Add room";

require_once "../core.php";

if(!isadmin()) die("Access denied");

require_once "../style/head.php";

$query = dbquery("SELECT * FROM `hotels`");
while($hotel = dbarray($query))
{
	updatehotelinfo($hotel['hotel_id']);
}


require_once "../style/foot.php";
?>