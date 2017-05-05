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
$pledge_sql = "INSERT INTO PLEDGE VALUES('".$_SESSION['loginname']."', '".$_GET['projectname']."', NOW(),  '".$_POST["pledge"]."');";
echo "<p>pledge success</p>";
mysqli_query($con, $pledge_sql);
echo "<p><a href='displayproject.php?projectname=".$_GET['projectname']."'>Back To Project!</a></p>";

?>

</body>
</html>
