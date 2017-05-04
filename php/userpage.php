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
		
		// Follow action
		$act_sql1 = "SELECT *
    FROM DISCUSS, `USER` WHERE USER.loginname=DISCUSS.loginname AND USER.loginname='".$_GET['uloginname']."'";
		$act_sql2 = "SELECT *
    FROM PROJECT, `USER` WHERE USER.loginname=PROJECT.loginname AND USER.loginname='".$_GET['uloginname']."'";
		$act_sql3 = "SELECT *
	FROM PLEDGE, `USER` WHERE USER.loginname=PLEDGE.loginname AND USER.loginname='".$_GET['uloginname']."'";
		$act_result1 = $con->query($act_sql1);
		$act_result2 = $con->query($act_sql2);
		$act_result3 = $con->query($act_sql3);
		echo "<p>Recent activity</p>";
		if ($act_result1->num_rows > 0) {
			while($row = $act_result1->fetch_assoc()) {
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> comment <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		if ($act_result2->num_rows > 0) {
			while($row = $act_result2->fetch_assoc()) {
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> create Project: <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		if ($act_result3->num_rows > 0) {
			while($row = $act_result3->fetch_assoc()) {
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> pledge <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		
		
		
		
		
		
		
		echo "<p><a id = 'back' href=\"./home.php\"><input type=\"button\" value=\"Back\"></input></a></p>";
	?>
	</body>
	<style>
		#foll{
			position:fixed;
			right:100px;
			top:100px;
			} 
		#back{
			position:fixed;
			right:100px;
			top:150px;
			} 
	</style>
</html>