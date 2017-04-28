<!DOCTYPE html>
<html>
	<body>
	<h1>Loged</h1>
	<?php		
		$mysql_server_name="127.0.0.1:3306"; //server name
		$mysql_username="root"; // username
		$mysql_password="root"; // password
		$mysql_database="kickfounder"; // database name
		$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
		if ($con->connect_error) {
			die("Database connect_error: " . $con->connect_error);
		}
		//check if user exist
		$user_check_sql = "SELECT loginname FROM USER WHERE loginname=\"".$_POST["loginname"]."\" AND password=\"".$_POST["password"]."\"";
		$user_result = $con->query($user_check_sql);
		if ($user_result->num_rows < 1) {
			echo "Your password or username is incorrect";
			echo "<p><a href=\"./index.php\"><input type=\"button\" value=\"Back to the Login page!\"></input></a></p>";
		}
		else {
			echo "Login Success!";
			// store customer name as session value
			session_start();
			$_SESSION['loginname'] = $_POST["loginname"];
			echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Go to Home\"></input></a></p>";
			
		}
	?>
	</body>
</html>