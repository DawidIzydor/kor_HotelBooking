<?php

$title = "Remove user";

require_once "../core.php";

if(!isadmin()) die("Access denied");

require_once "../style/head.php";

$users = dbquery("SELECT * FROM `users`");

if(isset($_POST['submit']))
{
	if(isset($_POST['user_id']) && $_POST['user_id'] != ""){
		$query = dbquery("SELECT `user_deleted` FROM users WHERE `user_id` = '".$_POST['user_id']."' AND `user_deleted` = '1'");
		if(dbrows($query)){
			$query = dbquery("DELETE FROM users WHERE `user_id` = '".$_POST['user_id']."' LIMIT 1");
		}else{
			$query = dbquery("UPDATE users SET `user_deleted` = '1' WHERE `user_id` = '".$_POST['user_id']."' LIMIT 1");
		}
	}
	
?>

Removed.

<?php

	
}else{
?>

<div class="panel panel-default">
	<div class="panel-heading">Remove user</div>
	<div class="panel-body">
		<form action="remove_user.php" method="post">
		
		<div class="form-group">
			<label for="user_id">Choose user</label>
			<select name="user_id" class="form-control">
<?php

	while($user = dbarray($users))
	{
		if($user['user_name'] == "admin") continue;
		echo '<option value="'.$user['user_id'].'">'.$user['user_name'].' '.($user['user_deleted'] == 1 ? "(pernament deletion!)" : "").'</option>';
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