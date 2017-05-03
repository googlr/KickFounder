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
		// add to user act
		$useract_sql = "INSERT INTO `USERACT` VALUES('".$_SESSION['loginname']."',now(), 'visusr', '".$_GET['uloginname']."')";
		mysqli_query($con, $useract_sql);
		
		// User Information
		$user_sql = "SELECT * FROM USER WHERE loginname=\"".$_GET['uloginname']."\"";
		$user_result = $con->query($user_sql);
		if ($user_result->num_rows > 0) {
			while($row = $user_result->fetch_assoc()) {

				echo "<p>Username: ".$row["username"]."</p>";
				echo "<p>".$row["say"]."</p>";
			}
		}
		//check if user already followed
		$follow_check_sql = "SELECT * FROM FOLLOW WHERE bfname=\"".$_GET['uloginname']."\" AND fname=\"".$_SESSION["loginname"]."\"";
		$follow_result = $con->query($follow_check_sql);
		if ($follow_result->num_rows < 1) {
			echo "<p><a id = 'foll' href='follownow.php?uloginname=".$_GET['uloginname']."'><input type=\"button\" value=\"Follow!\"></input></a></p>";
		}
		else {
			echo "<p><a id = 'foll' href='unfollow.php?uloginname=".$_GET['uloginname']."'><input type=\"button\" value=\"Unfollow!\"></input></a></p>";
			
		}
		
		echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Back\"></input></a></p>";
	?>
	</body>
	<style>
		#foll{
			position:fixed;
			right:100px;
			top:100px;
			} 
	</style>
</html>