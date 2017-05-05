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
	$like_sql = "DELETE FROM `LIKE` WHERE loginname='".$_SESSION['loginname']."' AND projectname='".$_GET['projectname']."'";
	//echo $like_sql;
	mysqli_query($con, $like_sql);
	echo "<p><a href='displayproject.php?projectname=".$_GET['projectname']."'>Back To Project!</a></p>";

?>

</body>
</html>
