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
	
$projectname = mysqli_real_escape_string($con, $_GET["projectname"]);
$loginname = $_SESSION['loginname'];

$sql_display_project = "select * from PROJECT WHERE projectname = '$projectname';";
$result_display_project = $con->query($sql_display_project);
$number_of_rows = mysqli_num_rows($result_display_project);

// add to user act
$useract_sql = "INSERT INTO `USERACT` VALUES('".$_SESSION['loginname']."',now(), 'vispro', '".$projectname."')";

mysqli_query($con, $useract_sql);

// display proj information
if($number_of_rows > 1){
echo "Database compromised, Projectname is duplicated"."<br>";
} else {
  echo "<h2>Here is the information of the project:</h2>";
  while ($row = mysqli_fetch_array($result_display_project)) {
    echo "<p>Project name: ".$row["projectname"]."</p>";
    echo "<p>Project description: ".$row["description"]."</p>";
    echo "<p>Project status: '".$row["projectstatus"]."'</p>";

    //TAG
    //display tags of project
    $sql_get_project_tag = "SELECT * from TAG WHERE projectname = '$projectname';";
    $result_get_project_tag = $con->query($sql_get_project_tag);
	echo "<p>Tags: ";
    while( $row_tag = mysqli_fetch_array($result_get_project_tag) ){
		echo "<a href='taglist.php?tagname=".$row_tag["tagname"]."'>[".$row_tag["tagname"]."] </a>";
    }
    echo "</p>";
    //user could also add tag of project
	$tag_button = "<form action='new_tag.php?projectname=".$projectname."' method='POST' >
                              <input type=\"text\" name=\"tag\">
							  <input type=\"submit\" name=\"submittag\" value=\"Add Tag\">
                            </form>";
    echo $tag_button."<br>";
	
	
	
	

    


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

        //RATE
        //if project is completed, ask owner to rate it
        if( $row["projectstatus"] == "completed" ){
        	$project_rate_button=
				"
					<div class=\"stars\">
  						<form action=\"rate_process.php\" method=\"POST\">
   							<input class=\"star star-5\" id=\"star-5\" type=\"radio\" value=\"5\" name=\"star\"/>
    						<label class=\"star star-5\" for=\"star-5\"></label>
    						<input class=\"star star-4\" id=\"star-4\" type=\"radio\" value=\"4\" name=\"star\"/>
    						<label class=\"star star-4\" for=\"star-4\"></label>
    						<input class=\"star star-3\" id=\"star-3\" type=\"radio\" value=\"3\" name=\"star\"/>
   							<label class=\"star star-3\" for=\"star-3\"></label>
    						<input class=\"star star-2\" id=\"star-2\" type=\"radio\" value=\"2\" name=\"star\"/>
    						<label class=\"star star-2\" for=\"star-2\"></label>
    						<input class=\"star star-1\" id=\"star-1\" type=\"radio\" value=\"1\" name=\"star\"/>
    						<label class=\"star star-1\" for=\"star-1\"></label>
    						<input type=\"submit\" name=\"submit\" value=\"submit\">
  						</form>
					</div>
				";
			echo $project_rate_button;
        }
    }
  }
}
// Pledge
//check if user create this project? if so cannot pledge his own project
$status_check_sql = "select * from PROJECT WHERE projectname = '$projectname';";
$status_result = $con->query($status_check_sql);
while ($row = mysqli_fetch_array($status_result)) {
	if ($row["projectstatus"] == "ongoing") {
		$project_check_sql = "SELECT * FROM PROJECT WHERE projectname=\"".$_GET['projectname']."\" AND loginname=\"".$_SESSION["loginname"]."\"";
		$pro_result = $con->query($project_check_sql);
		if ($pro_result->num_rows < 1) {
			echo "<form action='pledgeprocess.php?projectname=".$projectname."' method='post'>";
			echo "<b>Pledge This Project</b>";
			echo "<p>Pledge Amount: <input type='number' name='pledge' min=1></p>";
			echo "<p><input type='submit' value='pledgesubmit'></p>";
			echo "</form>"; 
		}
	}
}
	





// Like this project
//check if user already likeed
	$like_check_sql = "SELECT * FROM `LIKE` WHERE projectname=\"".$_GET['projectname']."\" AND loginname=\"".$_SESSION["loginname"]."\"";
	$like_result = $con->query($like_check_sql);
		if ($like_result->num_rows < 1) {
			echo "<p><a href='likeprocess.php?projectname=".$projectname."'><input type='button' value='Like This Project'></input></a></p>";
		}
		else {
			echo "<p><a href='unlikeprocess.php?projectname=".$projectname."'><input type='button' value='Not Like It'></input></a></p>";
			
		}

//List all comments
echo "<h2>Comment:</h2>";
$sql_display_comment = "select * from DISCUSS,USER WHERE DISCUSS.loginname=USER.loginname AND DISCUSS.projectname = '$projectname'; ";
$result_display_comment = $con->query($sql_display_comment);
while ($row_comment = mysqli_fetch_array($result_display_comment)) {
    //echo $row_comment["content"]."<br />";
    //TO_DO add button to lick to user
    echo "<p><a href='userpage.php?uloginname=".$row_comment["loginname"]."'>".$row_comment["username"]."</a>: ".$row_comment["content"]."</p>";
  }
echo "<p><a href=\"./home.php\"><input type=\"button\" value=\"Back\" class='backhome'></input></a></p>";

$fig_sql = "SELECT * FROM MATERIAL WHERE projectname='".$projectname."'";
$fig_result = $con->query($fig_sql);
	if ($fig_result->num_rows > 0) {
		echo "<p>Proejct material</p>";
		while($row = $fig_result->fetch_assoc()) {
			
			echo '<p><img height="100px" height="100px" src="data:image/jpeg;base64,'.base64_encode( $row['file'] ).'"/></p>';
		}
	}
?>


<form action="newcomment.php" method="POST" id='addcom'>
<textarea name="comment" rows="10" cols="30">
Add your comments here.
</textarea>
<input type="hidden" name="projectname" value="<?php echo $projectname; ?>">

<input type="submit" name="submit" value='submit'>
</form>


</body>

<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<style>
	.backhome{
		position:fixed;
		right:100px;
		top:100px;
	}
	#addcom{
		position:fixed;
		right:100px;
		top:200px;
	}

	div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>

</html>
