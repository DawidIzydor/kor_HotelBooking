<?php

require_once "config.php";
define("APP_STARTED", TRUE);

$dupa = dbconnect($db_ip, $db_user_name, $db_user_pass, $db_name);

$level = "";
$i = 0;
while (!file_exists($level."config.php")) {
	$level .= "../"; $i++;
	if ($i == 10) { die("config.php file not found"); } // max 10 folders levels
}

define("BASE", $level);

function isadmin()
{
	if(!isset($_COOKIE['HOTEL_MAN_USER']))
	{
		return false;
	}else{
		$user = explode(",", $_COOKIE['HOTEL_MAN_USER']);
		$query = dbquery("SELECT `user_level` FROM users WHERE `user_id` = '".$user[0]."' AND `user_pass` = '".$user[1]."'");
		if(dbarray($query)['user_level'] > 90)
		{
			return true;
		}else{
			return false;
		}
	}
}

function ismayor()
{
	if(!isset($_COOKIE['HOTEL_MAN_USER']))
	{
		return false;
	}else{
		$user = explode(",", $_COOKIE['HOTEL_MAN_USER']);
		$query = dbquery("SELECT `user_level` FROM users WHERE `user_id` = '".$user[0]."' AND `user_pass` = '".$user[1]."'");
		if(dbarray($query)['user_level'] > 9)
		{
			return true;
		}else{
			return false;
		}
	}
}

function updatehotelinfo($hotelid)
{
	$query = dbquery("SELECT * FROM hotels WHERE `hotel_id` = '".$hotelid."' LIMIT 1");
	if(dbrows($query))
	{
		$hotel = dbarray($query);
		
		
		$richest = dbarray(dbquery("SELECT `room_price` FROM rooms WHERE `hotel_id` = '".$hotelid."' ORDER BY `room_price` DESC LIMIT 1"))['room_price'];
		$poorest = dbarray(dbquery("SELECT `room_price` FROM rooms WHERE `hotel_id` = '".$hotelid."' ORDER BY `room_price` ASC LIMIT 1"))['room_price'];
		$numrooms = dbrows(dbquery("SELECT `room_id` FROM rooms WHERE `hotel_id` = '".$hotelid."'"));
		
		if($hotel['hotel_max_price'] < $richest || $hotel['hotel_min_price'] > $poorest || ($hotel['hotel_min_price'] == 0 && $poorest != 0) || $hotel['hotel_rooms'] != $numrooms)
		{
			$query = dbquery("UPDATE hotels SET `hotel_min_price` = '".$poorest."', `hotel_max_price` = '".$richest."', `hotel_rooms` = '".$numrooms."' WHERE `hotel_id` = '".$hotel['hotel_id']."' LIMIT 1");
		}
	}
}

function dbquery($query) {

	$result = @mysql_query($query);

	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		return $result;
	}
}

function dbcount($field, $table, $conditions = "") {

	$cond = ($conditions ? " WHERE ".$conditions : "");

	$result = @mysql_query("SELECT Count".$field." FROM ".$table.$cond);

	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		$rows = mysql_result($result, 0);
		return $rows;
	}
}

function dbresult($query, $row) {

	$result = @mysql_result($query, $row);

	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		return $result;
	}
}

function dbrows($query) {
	$result = @mysql_num_rows($query);
	return $result;
}

function dbarray($query) {
	$result = @mysql_fetch_assoc($query);
	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		return $result;
	}
}

function dbconnect($db_host, $db_user, $db_pass, $db_name) {
	
	$db_connect = @mysql_connect($db_host, $db_user, $db_pass);
	$db_select = @mysql_select_db($db_name);
	if (!$db_connect) {
		die("<strong>Unable to establish connection to MySQL</strong><br />".mysql_errno()." : ".mysql_error());

	} elseif (!$db_select) {
		die("<strong>Unable to select MySQL database</strong><br />".mysql_errno()." : ".mysql_error());
	}
}


?>