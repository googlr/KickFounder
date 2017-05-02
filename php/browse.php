<!DOCTYPE html>
<html>
	<body>
	<h1>Browse</h1>
	<?php
	    session_start();
		
		$keyw = $_POST["keyword"];
		
		$mysql_server_name="127.0.0.1:3306"; //server name
		$mysql_username="root"; // username
		$mysql_password="root"; // password
		$mysql_database="kickfounder"; // database name
		$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
		if ($con->connect_error) {
			die("Database connect_error: " . $con->connect_error);
		}		
		
		// Project list
		if ($keyw == "" ) {
				$project_sql = "SELECT * FROM PROJECT";
				$useract_sql = "INSERT INTO `USERACT` VALUES('".$_SESSION['loginname']."',now(), 'search', 'ALL*')";
			}
			else {
				$project_sql = "SELECT * FROM PROJECT WHERE projectname LIKE "."\"%".$keyw."%\"";
				$useract_sql = "INSERT INTO `USERACT` VALUES('".$_SESSION['loginname']."',now(), 'search', '".$keyw."')";
			}
		mysqli_query($con, $useract_sql);
		$project_result = $con->query($project_sql);
		echo "<p>Projects:</p>";
		if ($project_result->num_rows > 0) {
			
			while($row = $project_result->fetch_assoc()) {
				echo "<p><a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Back To Home\"></input></a></p>";
		
	?>
	</body>
</html>