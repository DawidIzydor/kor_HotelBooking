<?php

$title = "Login page";

require_once "core.php";
require_once "style/head.php";

if(isset($_COOKIE['HOTEL_MAN_USER'])){
	?><script> window.location.replace("index.php"); </script><?php
}else{

if(isset($_POST['submit']))
{
	if($_POST['user_name']=="" || $_POST['user_pass'] == "") die("User name or password not specified");
	
	$query = dbquery("SELECT `user_id` FROM users WHERE `user_name` = '".$_POST['user_name']."' AND `user_pass` = '".hash("sha256", $_POST['user_pass'])."' AND `user_deleted` != '1' LIMIT 1");
	
?>
<div class="panel panel-default">
	<div class="panel-heading">Post login</div>
	
	<div class="panel-body">
<?php
	if(dbrows($query))
	{
		
		setcookie("HOTEL_MAN_USER", dbarray($query)['user_id'].",".hash("sha256", $_POST['user_pass']));
?>
		You logged in successfully.
		<script> setTimeout(function(){window.location.replace("index.php");}, 3000); </script>
<?php		
	}else{
?>
		Wrong username or password.

<?php
	}
?>

	</div>
</div>
<?php
}else{
?>

<div class="panel panel-default">
	<div class="panel-heading">Login</div>
	
	<div class="panel-body">
		<form class="form-horizontal" action="login.php" method="post">
			<div class="form-group">
				<label for="user_name" class="col-sm-2 control-label">User name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="user_name" name="user_name" placeholder="User name" maxlength="255">
				</div>
			</div>
				
			<div class="form-group">
				<label for="user_pass" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Password" maxlength="255">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
		</form>
		
	</div>
</div>

<?php
}

}

require_once "style/foot.php";

?>