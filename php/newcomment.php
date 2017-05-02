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
echo $projectname;
$sql_display_project = "INSERT INTO DISCUSS VALUES('".$projectname."','".$loginname."', Now(), '".$content."' )";
echo $sql_display_project;
mysqli_query($con, $sql_display_project);
echo "Comment successfully."."<br>";
echo "<p><a href='displayproject.php?projectname=".$projectname."'>Back To Project!</a></p>";
?>


</body>
</html>
