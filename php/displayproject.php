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

$projectname = $_GET["projectname"];
$loginname = $_SESSION['loginname'];

$con = mysql_connect("localhost","root","guoxiujia");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("kickfounder", $con);

$sql_display_project = "select * from PROJECT WHERE projectname = '$projectname';";
$result_display_project = mysql_query($sql_display_project, $con);
$number_of_rows = mysql_num_rows($result_display_project);

if($number_of_rows > 0){
echo "Database compromised, Projectname is duplicated"."<br>";
} else {
  echo "<h2>Here is the information of the project:</h2>";
  while ($row = mysql_fetch_array($result_display_project)) {
    echo $row."<br />";
    //if user is owner of project, display upload option
    if($loginname == $row['loginname']){
          $upload_button = "<form action = \"newupload.php\" method = \"POST\">
                              <input type = \"submit\" name = \"Upload\">
                            </form>";
          echo $upload."<br>";
    }
  }
}


//List all comments
echo "<h2>Comment:</h2>";
$sql_display_comment = "select * from DISCUSS WHERE projectname = '$projectname'; ";
$result_display_comment = mysql_query($sql_display_comment, $con);
while ($row_comment = mysql_fetch_array($result_display_project)) {
    echo $row_comment."<br />";
    //TO_DO add button to lick to user
  }

mysql_close($con);
?>

//user add new comment
<form action="newcomment.php" method="POST">
<textarea name="comment" rows="10" cols="30">
The cat was playing in the garden.
</textarea>
<input type="hidden" name="projectname" value="'$projectname'">
<input type="hidden" name="loginname" value="'$loginname'">
<input type="submit" name="submit">
</form>

</body>
</html>
