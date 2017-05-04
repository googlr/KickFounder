<?php 
session_start();
echo "SESSION START!"; 
if( ! isset($_SESSION['loginname']) )
  $_SESSION['loginname'] = $_POST["loginname"];
?>

<!DOCTYPE html>
<html>
<body>

<?php

$projectname = $_POST["projectname"];
$loginname = $_SESSION['loginname'];
$content = $_POST["comment"];

$mysql_server_name="127.0.0.1:3306"; //server name
$mysql_username="root"; // username
$mysql_password="root"; // password
$mysql_database="kickfounder"; // database name
$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
if ($con->connect_error) {
	die("Database connect_error: " . $con->connect_error);
	}

$sql_display_project = "INSERT INTO DISCUSS VALUES('".$projectname."','".$loginname."', Now(), ? )";



/* Prepared statement, stage 1: prepare */
	if (!($stmt = $con->prepare($sql_display_project))) {
    		echo "Prepare failed: (" . $con->errno . ") " . $con->error;
		}

		//bind the variables to the stmt
		$stmt -> bind_param("s", $content);
		//execute
		$stmt ->execute();


echo "Comment successfully."."<br>";
echo "<p><a href='displayproject.php?projectname=".$projectname."'>Back To Project!</a></p>";
?>


</body>
</html>
