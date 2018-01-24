<?php

$title = "Add user";

require_once "../core.php";

if(!isadmin()) die("Access denied");

require_once "../style/head.php";

if(isset($_POST['submit']))
{
	
	if($_POST['user_name'] == "") {die("User must have a name");}
	if($_POST['user_pass'] == "") {die("User must have a password");}
	
	$query = dbquery("INSERT INTO users (`user_name`, `user_pass`, `user_level`, `user_firstname`, `user_lastname`, `user_tel`, `user_adress`)
						VALUES ('".$_POST['user_name']."', '".hash("sha256", $_POST['user_pass'])."', '".$_POST['user_access']."', '".$_POST['user_fname']."', '".$_POST['user_lname']."',  '".$_POST['user_tel']."', '".$_POST['user_adress']."') ")
?>

Added.

<?php

	
}else{
?>

<div class="panel panel-default">
	<div class="panel-heading">Add user</div>
	<div class="panel-body">
		<form action="add_user.php" method="post">
		
		<div class="form-group">
			<label for="user_name">User name*</label>
			<input type="text" class="form-control" id="user_name" name="user_name" placeholder="User name" maxlength="255">
		</div>
		
		<div class="form-group">
			<label for="user_pass">Password*</label>
			<input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Password" maxlength="255">
		</div>
		
		<div class="form-group">
			<label for="user_access">Access level</label>
			<select name="user_access" class="form-control">
				<option value="1">Normal user</option>
				<option value="10">Mayor</option>
				<option value="99">Administrator</option>
			</select>
		</div>
		
		<div class="form-group">
			<label for="user_email">E-mail</label>
			<input type="email" class="form-control" id="user_email" name="user_email" placeholder="E-mail" maxlength="255">
		</div>
		
		<div class="form-group">
			<label for="user_fname">First name</label>
			<input type="text" class="form-control" id="user_fname" name="user_fname" placeholder="User first name" maxlength="255">
		</div>
		
		<div class="form-group">
			<label for="user_lname">Last name</label>
			<input type="text" class="form-control" id="user_lname" name="user_lname" placeholder="User last name" maxlength="255">
		</div>
		
		<div class="form-group">
			<label for="user_adress">Adress</label>
			<input type="text" class="form-control" id="user_adress" name="user_adress" placeholder="User adress" maxlength="255">
		</div>
		
		<div class="form-group">
			<label for="user_tel">Telephone</label>
			<input type="number" class="form-control" id="user_tel" name="user_tel" placeholder="User telephone" maxlength="255">
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