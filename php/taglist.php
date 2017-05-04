<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php


    $mysql_server_name="127.0.0.1:3306"; //server name
	$mysql_username="root"; // username
    $mysql_password="root"; // password
    $mysql_database="kickfounder"; // database name
    $con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    if ($con->connect_error) {
	    die("Database connect_error: " . $con->connect_error);
	}
	$tagname = mysqli_real_escape_string($con, $_GET['tagname']);	
		
    $tag_sql = "select * from TAG WHERE tagname = '".$tagname."';";
    $tag_result = $con->query($tag_sql);
    echo "<h1>Project related to this tag:</h1>";
		if ($tag_result->num_rows > 0) {
			while($row = $tag_result->fetch_assoc()) {
				echo "<p><a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
				
			}
		}
		echo "</table>";
		echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Back To Home\"></input></a></p>";
?>
</body>
</html>
