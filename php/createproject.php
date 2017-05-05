<?php 
session_start();
//echo "SESSION START!"; 
if( ! isset($_SESSION['loginname']) )
  $_SESSION['loginname'] = $_POST["loginname"];
?>

<!DOCTYPE html>
<html>
<body>

<?php
    function test_input($data) {
  			$data = trim($data);
  			$data = stripslashes($data);
  			$data = htmlspecialchars($data);
  			return $data;
	}
	




$mysql_server_name="127.0.0.1:3306"; //server name
$mysql_username="root"; // username
$mysql_password="root"; // password
$mysql_database="kickfounder"; // database name
$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
if ($con->connect_error) {
	die("Database connect_error: " . $con->connect_error);
	}

$loginname = $_SESSION['loginname'];
$projectname = test_input($_POST["projectname"]);
$description = $_POST["description"];
$projectstatus = "ongoing";
$minfund = $_POST["minfund"];
$maxfund = $_POST["maxfund"];
$posttime;
$endtime = $_POST["pledgetime"]." 00:00:00";
$plantime = $_POST["plantime"]." 00:00:00";

$sql_validate_projectname = "select * from PROJECT WHERE projectname = '".$projectname."'";
$result_validate_projectname = $con->query($sql_validate_projectname);
$number_of_rows = $result_validate_projectname->num_rows;

if($number_of_rows > 0){
echo "Projectname is duplicated"."<br>";
require("newproject.php"); 
} else {  

$sql_insert_new_project =
"INSERT INTO PROJECT VALUES(
        '$projectname',
        '$loginname',
        '$description',
        '$projectstatus',
        '$minfund',
        '$maxfund',
        Now(),
        '$endtime',
        '$plantime');
";
$sql_insert_new_project =
"INSERT INTO PROJECT VALUES(?, ?, ?, ?, ?, ?, Now(),?,?)";




/* Prepared statement, stage 1: prepare */
	if (!($stmt = $con->prepare($sql_insert_new_project))) {
    		echo "Prepare failed: (" . $con->errno . ") " . $con->error;
		}

		//bind the variables to the stmt
		$stmt -> bind_param("ssssssss", $projectname, $loginname, $description, $projectstatus, $minfund, $maxfund, $endtime, $plantime);
		//execute
		$stmt ->execute();



}
?>

<form action="home.php" method="post">
<input type="submit" value="Back to my homePage!">
 <input type="hidden" name="loginname" value="<?php echo $_SESSION['loginname']; ?>">
</form>

</body>
</html>
