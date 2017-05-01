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
$con = mysql_connect("localhost","root","guoxiujia");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("kickfounder", $con);

$loginname = $_SESSION['loginname'];
$projectname = $_POST["projectname"];
$description = $_POST["description"];
$projectstatus = "ongoing";
$minfund = $_POST["minfund"];
$maxfund = $_POST["maxfund"];
$posttime;
$endtime = $_POST["pledgetime"]." 00:00:00";
$plantime = $_POST["plantime"]." 00:00:00";

$sql_validate_projectname = "select * from PROJECT WHERE projectname = '$projectname';";
$result_validate_projectname = mysql_query($sql_validate_projectname, $con);
$number_of_rows = mysql_num_rows($result_validate_projectname);

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


if(mysql_query($sql_insert_new_project, $con)) {
    echo "New record created successfully";
} else {
echo mysql_errno($con) . ": " . mysql_error($con) . "<br />";  
    echo "Error: " . $sql_insert_new_project . "<br>";
}

}
mysql_close($con);
?>

<form action="home.php" method="post">
<input type="submit" value="Back to my homePage!">
 <input type="hidden" name="loginname" value="<?php echo $_SESSION['loginname']; ?>">
</form>

</body>
</html>
