<?php 
session_start();
echo "SESSION START!<br>"; 
?>

<!DOCTYPE html>
<html>
<body>

<?php
echo "Uploading files...<br>";
$projectname=$_GET["projectname"];
if (isset($_FILES['file'])) {
	echo "setted";
	echo $_GET["projectname"];
}
else
{echo "Not set";}

        // record the upload into the database

	  	$loginname = $_SESSION['loginname'];
	  	$matdes = $_POST["matdes"];
		$file = addslashes(file_get_contents($_FILES['file']['tmp_name']));
      	$mysql_server_name="127.0.0.1:3306"; //server name
		$mysql_username="root"; // username
		$mysql_password="root"; // password
		$mysql_database="kickfounder"; // database name
		$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
		if ($con->connect_error) {
			die("Database connect_error: " . $con->connect_error);
		}

		$sql_new_upload_file = "INSERT INTO MATERIAL VALUES('$projectname', Now(), '$matdes', '$file' );";
		mysqli_query($con, $sql_new_upload_file);
		echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Back To Home\"></input></a></p>";
		$fig_sql = "SELECT * FROM MATERIAL WHERE projectname='".$projectname."'";
		$fig_result = $con->query($fig_sql);
		if ($fig_result->num_rows > 0) {
			while($row = $fig_result->fetch_assoc()) {
				echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['file'] ).'"/>';
			}
		}

?>


</body>
</html>
