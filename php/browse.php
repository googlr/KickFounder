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
		echo "<p>Projects:</p>";
		// Project list
		if ($keyw == "" ) {
				$project_sql = "SELECT * FROM PROJECT";
				$useract_sql = "INSERT INTO `USERACT` VALUES('".$_SESSION['loginname']."',now(), 'search', 'ALL*')";
				$project_result = $con->query($project_sql);
				if ($project_result->num_rows > 0) {
			        while($row = $project_result->fetch_assoc()) {
				        echo "<p><a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
					}
            }
		
		}
		else {
			//$project_sql = "SELECT * FROM PROJECT WHERE projectname LIKE "."\"%".$keyw."%\"";

			/* Prepared statement, stage 1: prepare */
			if (!($stmt = $con->prepare("SELECT * FROM PROJECT WHERE projectname LIKE ?"))) {
    			echo "Prepare failed: (" . $con->errno . ") " . $con->error;
			}
				//bind the variables to the stmt
				$keywords = "%".$keyw."%";
				$stmt -> bind_param("s",$keywords);
				//execute
				$stmt ->execute();
				$project_result = $stmt->get_result();
				
				if ($project_result->num_rows > 0) {
			
			        while($row = $project_result->fetch_assoc()) {
				        echo "<p><a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
					}
				}
				$stmt -> close();


				//$useract_sql = "INSERT INTO `USERACT` VALUES('".$_SESSION['loginname']."',now(), 'search', '".$keyw."')";
				/* Prepared statement, stage 1: prepare */
				if (!($ureract_stmt = $con->prepare("INSERT INTO `USERACT` VALUES('".$_SESSION['loginname']."',now(), 'search', ?)"))) {
 			   		echo "Prepare failed: (" . $con->errno . ") " . $con->error;
				}

				//bind the variables to the ureract_stmt
				$ureract_keyw = $keyw;
				$ureract_stmt -> bind_param("s", $ureract_keyw );
				//execute
				$ureract_stmt ->execute();
				
				
				
			}

		
		
		echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Back To Home\"></input></a></p>";
		
	?>
	</body>
</html>