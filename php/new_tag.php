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

	$projectname = mysqli_real_escape_string($con, $_GET["projectname"]);
	$tagname = mysqli_real_escape_string($con, $_POST["tag"]);	
		
		
	$sql_new_tag = "INSERT INTO TAG VALUES('$projectname', '$tagname');";

	mysqli_query($con, $sql_new_tag);
	echo "<p><a href='displayproject.php?projectname=".$_GET['projectname']."'>Back To Project!</a></p>";

?>

</body>
</html>
