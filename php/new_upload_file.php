<?php 
session_start();
echo "SESSION START!"; 
?>

<!DOCTYPE html>
<html>
<body>

<?php
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000))
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

      //record the upload into the database
      	$projectname = $_POST["projectname"];
	  	$loginname = $_SESSION['loginname'];
	  	$matdes = $_POST["matdes"];
		$file = $_POST["file"];

		$con = mysql_connect("localhost","root","guoxiujia");
		if (!$con){
  			die('Could not connect: ' . mysql_error());
  		}

		mysql_select_db("kickfounder", $con);

		$sql_new_upload_file = "INSERT INTO MATERIAL VALUES('$projectname', Now(), $matdes, $file );";

		mysql_query($sql_new_upload_file, $con);

		mysql_close($con);
    	}
  }
else
  {
  echo "Invalid file";
  }
?>


</body>
</html>
