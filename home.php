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
		echo "<p><a href=\"./newproject.php\"><input type=\"button\" value=\"Create New Projects\"></input></a></p>";
		echo "<p><a href=\"./useredit.php\"><input type=\"button\" value=\"Edit My Profile\"></input></a></p>";
		echo "<p><a href=\"./logout.php\"><input type=\"button\" value=\"Log Out\"></input></a></p>";
		echo "<form action='browse.php' method='post'>";
		echo "<p>Keyword: <input type='text' name='keyword'></p>";
		echo "<p><input type='submit' value='Develop!',name='find'></p>";
		echo "</form>";
		if(!empty($_POST['find'])){
			echo $_POST['keyword'];
		}
		
		// Project list
		$project_sql = "SELECT projectname FROM PROJECT WHERE loginname=\"".$_SESSION['loginname']."\"";
		$project_result = $con->query($project_sql);
		echo "<p>My Projects:</p>";
		if ($project_result->num_rows > 0) {
			
			while($row = $project_result->fetch_assoc()) {
				echo "<p><a href=\"signup.php\">".$row["projectname"]."</a></p>";
			}
		}
		
		// Like list
		$like_sql = "SELECT projectname FROM `LIKE` WHERE loginname=\"".$_SESSION['loginname']."\"";
		$like_result = $con->query($like_sql);
		echo "<p>My LIKES:</p>";
		if ($like_result->num_rows > 0) {
			while($row = $like_result->fetch_assoc()) {
				echo "<p><a href=\"signup.php\">".$row["projectname"]."</a></p>";
			}
		}
		
		// Pledge List
		$pledge_sql = "SELECT * FROM PLEDGE WHERE loginname=\"".$_SESSION['loginname']."\"";
		$pledge_result = $con->query($pledge_sql);
		echo "<p>My PLEDGE:</p>";
		echo "<table><tr> <th>Project</th> <th>Founder</th> <th>Pledge Time</th><th>Amount</th></tr>";
		if ($pledge_result->num_rows > 0) {
			while($row = $pledge_result->fetch_assoc()) {
				echo "<tr>";
				echo "<td><p><a href=\"signup.php\">".$row["projectname"]."</a></p></td>";
				echo "<td><p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["loginname"]."</a></p></td>";
				echo "<td><p>".$row["pledgetime"]."</p></td>";
				echo "<td><p>".$row["amount"]."</p></td>";
				echo "</tr>";
			}
		}
		echo "</table>";
		
		// Follow List
		$follow_sql = "SELECT * FROM FOLLOW WHERE fname=\"".$_SESSION['loginname']."\"";
		$follow_result = $con->query($follow_sql);
		echo "<p>My Follow:</p>";
		if ($follow_result->num_rows > 0) {
			while($row = $follow_result->fetch_assoc()) {
				echo "<p><a href='userpage.php?uloginname=".$row["bfname"]."'>".$row["bfname"]."</a></p>";
			}
		}
		
	?>
	</body>
</html>