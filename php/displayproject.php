<?php 
session_start();
echo "SESSION START!"; 
?>

<!DOCTYPE html>
<html>
<body>

<?php

$projectname = $_GET["projectname"];
$loginname = $_SESSION['loginname'];

$mysql_server_name="127.0.0.1:3306"; //server name
$mysql_username="root"; // username
$mysql_password="root"; // password
$mysql_database="kickfounder"; // database name
$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
if ($con->connect_error) {
	die("Database connect_error: " . $con->connect_error);
	}

$sql_display_project = "select * from PROJECT WHERE projectname = '$projectname';";
$result_display_project = $con->query($sql_display_project);
$number_of_rows = mysqli_num_rows($result_display_project);


// display proj information
if($number_of_rows > 1){
echo "Database compromised, Projectname is duplicated"."<br>";
} else {
  echo "<h2>Here is the information of the project:</h2>";
  while ($row = mysqli_fetch_array($result_display_project)) {
    echo "<p>".$row["projectname"]."</p>";
	echo "<p>".$row["description"]."</p>";
	
	
	
	
    //if user is owner of project, display upload option
    if($loginname == $row['loginname']){
          $upload_button = "<form action=\"new_upload_file.php?projectname=".$projectname."\" method=\"POST\" enctype=\"multipart/form-data\">
                              <label for=\"file\">Filename < 20M:</label>
                              <input type=\"file\" name=\"file\" /> 
                              <br />
                              Material Description:<br>
                              <input type=\"text\" name=\"matdes\">
                              <input type=\"submit\" name=\"submit\" value=\"Submit\"/>
                            </form>";
          echo $upload_button."<br>";
    }
  }
}
//

//List all comments
echo "<h2>Comment:</h2>";
$sql_display_comment = "select * from DISCUSS,USER WHERE DISCUSS.loginname=USER.loginname AND DISCUSS.projectname = '$projectname'; ";
$result_display_comment = $con->query($sql_display_comment);
while ($row_comment = mysqli_fetch_array($result_display_comment)) {
    echo $row_comment["content"]."<br />";
    //TO_DO add button to lick to user
    echo "<p><a href='userpage.php?uloginname=".$row_comment["loginname"]."'>".$row_comment["username"]."</a></p>";
  }
echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Back\"></input></a></p>";
?>

User add new comment:
<form action="newcomment.php" method="POST">
<textarea name="comment" rows="10" cols="30">
Add your comments here.
</textarea>
<input type="hidden" name="projectname" value="<?php echo $projectname; ?>">

<input type="submit" name="submit">
</form>

</body>
</html>
