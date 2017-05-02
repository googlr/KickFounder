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
/**
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }

echo $_FILES["file"]["type"];
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
**/
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
