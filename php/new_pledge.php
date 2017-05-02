<?php 
session_start();
echo "PLEDGE SESSION START!<br>"; 
?>

<!DOCTYPE html>
<html>
<body>

<?php

$projectname = $_POST["projectname"];
$loginname = $_SESSION['loginname'];
$amount = $_POST["amount"];

$mysql_server_name="127.0.0.1:3306"; //server name
$mysql_username="root"; // username
$mysql_password="root"; // password
$mysql_database="kickfounder"; // database name
$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
if ($con->connect_error) {
	die("Database connect_error: " . $con->connect_error);
	}

$sql_new_pledge = "INSERT INTO PLEDGE VALUES('$projectname', '$loginname', Now(), '$amount')";
$result_new_pledge = $con->query($sql_new_pledge);

echo "You have Pledged successfully with ".$amount." $ for ".$projectname."<br>";

?>

<form action="displayproject.php" method="GET">
<input type="hidden" name="projectname" value="<?php echo $projectname; ?>">
<input type="submit" name="submit" value="Go back to project info">
</form>

</body>
</html>
