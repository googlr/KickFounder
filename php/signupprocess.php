<!DOCTYPE html>
<html>
	<body>
	<h1>Online Shopping System</h1>
	<?php

		function test_input($data) {
  			$data = trim($data);
  			$data = stripslashes($data);
  			$data = htmlspecialchars($data);
  			return $data;
		}

		$username = test_input( $_POST["username"] );
		$loginname = test_input( $_POST["loginname"] );
		$password = test_input( $_POST["password"] );
		// hash password
		$password = password_hash($password, PASSWORD_DEFAULT);
		

		$mysql_server_name="127.0.0.1:3306"; //server name
		$mysql_username="root"; // username
		$mysql_password="root"; // password
		$mysql_database="kickfounder"; // database name
		$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
		if ($con->connect_error) {
			die("Database connect_error: " . $con->connect_error);
		}
		//check if user exist
		$user_check_sql = "SELECT loginname FROM user WHERE loginname=\"".$loginname."\"";
		$user_result = $con->query($user_check_sql);
		if ($user_result->num_rows > 0) {
			echo "User already exist!";
		}
		else {
			echo $password;
			$insert_user_sql = "INSERT INTO `USER`(`loginname`, `username`, `password`) VALUES('".$loginname."','".$username."','".$password."')";
			mysqli_query($con, $insert_user_sql);
			echo "Sign Up Success!";
		}
		echo "<p><a href=\"./index.php\"><input type=\"button\" value=\"Back to the Login page!\"></input></a></p>";
	?>
	</body>
</html>