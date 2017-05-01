<!DOCTYPE html>
<html>
	<body>
	<h1>Edit Success</h1>
	<?php
		session_start();
		$curr_login = $_SESSION['loginname'];
		$mysql_server_name="127.0.0.1:3306"; //server name
		$mysql_username="root"; // username
		$mysql_password="root"; // password
		$mysql_database="kickfounder"; // database name
		$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
		if ($con->connect_error) {
			die("Database connect_error: " . $con->connect_error);
		}
		$update_user_sql = "UPDATE USER SET say = \"".$_POST['say']."\",
		    hometown=\"".$_POST['hometown']."\", interests=\"".$_POST['interests']."\",
			creditcard=\"".$_POST['creditcard']."\" WHERE loginname=\"".$curr_login."\"";
		mysqli_query($con, $update_user_sql);
		echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Back\"></input></a></p>";
	?>
	</body>
</html>