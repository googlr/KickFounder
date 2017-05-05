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
		$unfollow_sql = "DELETE FROM FOLLOW WHERE bfname=\"".$_GET['uloginname']."\" AND fname=\"".$_SESSION["loginname"]."\"";
		$unfollow_result = $con->query($unfollow_sql);
		echo "<p><a href='userpage.php?uloginname=".$_GET['uloginname']."'><input type=\"button\" value=\"Back\"></input></a></p>";
		//echo $_GET['uloginname'];
		
		
	?>
	</body>
</html>