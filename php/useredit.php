<!DOCTYPE html>
<html>
	<body>
	<h1>User Profile</h1>
	<?php
		session_start();
		$curr_login = $_SESSION['loginname'];
		echo "<p>Your name:".$curr_login."</p>";
		if(!empty($_POST['uedit'])){
			echo $_POST['say'];
			echo $_POST['hometown'];
			echo $_POST['interests'];
			echo $_POST['creditcard'];
		}
		echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Cancel Change and back\"></input></a></p>";
	?>
	<form action='editcomplete.php' method='post'>
		<p>Description: <input type='text' name='say'></p>
		<p>Hometown: <input type='text' name='hometown'></p>
		<p>Interests: <input type='text' name='interests'></p>
		<p>Credit Card: <input type='text' name='creditcard'></p>
		<p><input type='submit' value='submit',name='uedit'></p>
	</form>
	</body>
</html>