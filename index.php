<!DOCTYPE html>
<html>
	<body>
	<h1>Kickfounder</h1>
	<?php
		if(!empty($_POST['login'])){
			echo $_POST['loginname'];
			echo $_POST['password'];
		}
	?>
	<form action='loged.php' method='post'>
		<p>User name: <input type='text' name='loginname'></p>
		<p>password: <input type='text' name='password'></p>
		<p><input type='submit' value='login',name='login'></p>
	</form>
	<p><a href="signup.php"><input type="button" value="Sign Up Now!"></a></p>

	</body>
</html>