<!DOCTYPE html>
<html>
	<body>
	<h1>User Home</h1>
	<?php
	    session_start();
		$mysql_server_name="127.0.0.1:3306"; //server name
		$mysql_username="root"; // username
		$mysql_password="root"; // password
		$mysql_database="kickfounder"; // database name
		$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
		if ($con->connect_error) {
			die("Database connect_error: " . $con->connect_error);
		}
		//check if user already followed
		$follow_check_sql = "SELECT * FROM FOLLOW WHERE bfname=\"".$_GET['uloginname']."\" AND fname=\"".$_SESSION["loginname"]."\"";
		$follow_result = $con->query($follow_check_sql);
		if ($follow_result->num_rows < 1) {
			echo "Follow Me?";
			echo "<p><a href='follownow.php?uloginname=".$_GET['uloginname']."'><input type=\"button\" value=\"Follow!\"></input></a></p>";
		}
		else {
			echo "Following";
			echo "<p><a href='unfollow.php?uloginname=".$_GET['uloginname']."'><input type=\"button\" value=\"Unfollow!\"></input></a></p>";
			
		}
		echo $_GET['uloginname'];
		
		
	?>
	</body>
</html>