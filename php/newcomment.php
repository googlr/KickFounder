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

$con = mysql_connect("localhost","root","guoxiujia");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("kickfounder", $con);

$sql_display_project = "INSERT INTO DISCUSS VALUES('$projectname','$loginname', Now(), $content );";

mysql_query($sql_display_project, $con);
echo "Comment successfully."."<br>";

mysql_close($con);
?>


</body>
</html>
