<!DOCTYPE html>
<?php 
session_start();

?>

<html>
	<body>
	<?php
	    if (isset($_COOKIE["user"])) {
			$_SESSION['loginname'] = $_COOKIE["user"];
		}
            
        else {
			if (isset($_SESSION['loginname'])) {
				$myuser = $_SESSION['loginname'];
			}
			else {
				echo "<p><a href=\"./index.php\"><input type=\"button\" value=\"Back to the Login page!\"></input></a></p>";
				die("Session or Cookie Error!");
				exit();
			}
			
		}
            
		echo "<h2>User Home: ".$_SESSION['loginname']."</h2>";
		$mysql_server_name="127.0.0.1:3306"; //server name
		$mysql_username="root"; // username
		$mysql_password="root"; // password
		$mysql_database="kickfounder"; // database name
		$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
		if ($con->connect_error) {
			die("Database connect_error: " . $con->connect_error);
		}
		
		

		echo "<p id='newproject'><a href=\"./newproject.php\"><input type=\"button\" value=\"Create New Projects\"></input></a></p>";
		echo "<p id='charge'><a href=\"./charge.php\"><input type=\"button\" value=\"Go to my charge record\"></input></a></p>";
		echo "<p id='edit'><a href=\"./useredit.php\"><input type=\"button\" value=\"Edit My Profile\"></input></a></p>";
		echo "<p id='logout' ><a href=\"./logout.php\"><input type=\"button\" value=\"Log Out\"></input></a></p>";
		echo "<p id='acthistory'><a href=\"./acthistory.php\"><input type=\"button\" value=\"Activity History\"></input></a></p>";
		
		echo "<form action='browse.php' method='post' id='sertable'>";
		echo "<p>Keyword: <input type='text' name='keyword'>    ";
		echo "<input type='submit' value='Develop!',name='find'></p>";
		echo "</form>";
		
		
		if(!empty($_POST['find'])){
			echo $_POST['keyword'];
		}
		
		// Project list
		
		$project_sql = "SELECT projectname FROM PROJECT WHERE loginname=\"".$_SESSION['loginname']."\"";
		$project_result = $con->query($project_sql);
		echo "<table id='mypro'><tr> <th>My Projects:</th></tr>";
		if ($project_result->num_rows > 0) {
			
			while($row = $project_result->fetch_assoc()) {
				echo "<tr><td><p><a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p></td></tr>";
			}
		}
		echo "</table>";
		// Like list
		
		$like_sql = "SELECT projectname FROM `LIKE` WHERE loginname=\"".$_SESSION['loginname']."\"";
		$like_result = $con->query($like_sql);
		echo "<table id='mylike'><tr> <th>My LIKES:</th></tr>";
		if ($like_result->num_rows > 0) {
			while($row = $like_result->fetch_assoc()) {
				echo "<tr><td><p><a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p></td></tr>";
			}
		}

		echo "</table id='pledge'>";
		// Pledge List
		$pledge_sql = "SELECT * FROM PLEDGE WHERE loginname=\"".$_SESSION['loginname']."\"";
		$pledge_result = $con->query($pledge_sql);
		echo "<b>My PLEDGE:</b>";
		echo "<table><tr> <th>Project</th><th>Pledge Time</th><th>Amount</th></tr>";
		if ($pledge_result->num_rows > 0) {
			while($row = $pledge_result->fetch_assoc()) {
				echo "<tr>";
				echo "<td><p><a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p></td>";
				echo "<td><p>".$row["pledgetime"]."</p></td>";
				echo "<td><p>".$row["amount"]."</p></td>";
				echo "</tr>";
			}
		}
		echo "</table>";
		
		// Follow List
		$follow_sql = "SELECT * FROM FOLLOW, USER WHERE USER.loginname=FOLLOW.bfname AND fname=\"".$_SESSION['loginname']."\"";
		$follow_result = $con->query($follow_sql);
		echo "<table id='myfoll'><tr><th>My FOLLOWS:</th></tr>";
		if ($follow_result->num_rows > 0) {
			while($row = $follow_result->fetch_assoc()) {
				echo "<tr><td><p><a href='userpage.php?uloginname=".$row["bfname"]."'>".$row["username"]."</a></p></td></tr>";
			}
		}
		echo "</table>";
		
		// Follow action
		$act_sql1 = "SELECT *
    FROM DISCUSS, `USER` WHERE USER.loginname=DISCUSS.loginname AND USER.loginname IN (
        SELECT bfname FROM FOLLOW WHERE fname=\"".$_SESSION['loginname']."\") ORDER BY commenttime DESC";
		$act_sql2 = "SELECT *
    FROM PROJECT, `USER` WHERE USER.loginname=PROJECT.loginname AND USER.loginname IN (
        SELECT bfname FROM FOLLOW WHERE fname=\"".$_SESSION['loginname']."\") ORDER BY posttime DESC";
		$act_sql3 = "SELECT *
	FROM PLEDGE, `USER` WHERE USER.loginname=PLEDGE.loginname AND USER.loginname IN (
        SELECT bfname FROM FOLLOW WHERE fname=\"".$_SESSION['loginname']."\") ORDER BY pledgetime DESC";
		$act_result1 = $con->query($act_sql1);
		$act_result2 = $con->query($act_sql2);
		$act_result3 = $con->query($act_sql3);
		echo "<b>My Follow News</b>";
		
		if ($act_result1->num_rows > 0) {
			$count=0;
			while($row = $act_result1->fetch_assoc()) {
				$count=$count + 1;
				if ($count > 3) {break;}
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> comment <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		if ($act_result2->num_rows > 0) {
			$count=0;
			while($row = $act_result2->fetch_assoc()) {
				$count=$count + 1;
				if ($count > 3) {break;}
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> create Project: <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		if ($act_result3->num_rows > 0) {
			$count=0;
			while($row = $act_result3->fetch_assoc()) {
				$count=$count + 1;
				if ($count > 3) {break;}
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> pledge <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		
		// recommendation system
		
		
		$rec_sql="SELECT tagname, COUNT(tagname) AS tag_num
		    FROM tag WHERE projectname in 
			(SELECT distinct actvalue FROM USERACT WHERE loginname='".$_SESSION['loginname']."' AND acttype='vispro')
			GROUP BY tagname ORDER BY tag_num DESC LIMIT 0,2";
		$rec_result = $con->query($rec_sql);
		$projarr = array();
	    if ($rec_result->num_rows > 0) {
			
			while($row = $rec_result->fetch_assoc()) {

				$rec_proj_sql="SELECT projectname FROM tag where tagname='".$row["tagname"]."' AND projectname not in 
				    (SELECT projectname FROM `LIKE` where `LIKE`.loginname='".$_SESSION['loginname']."')";
				$rec_proj_result=$con->query($rec_proj_sql);
				if ($rec_proj_result->num_rows > 0) {
					while($row_proj = $rec_proj_result->fetch_assoc()) {
						$projarr[]=$row_proj["projectname"];
					}
				}

			}
		}
		$projarr = array_flip(array_flip($projarr));
		echo "<table id='myrecom'><tr> <th>Recommed projects</th></tr>";
		foreach ($projarr as $recom_proj){ 
		    echo "<tr><td><a href='displayproject.php?projectname=".$recom_proj."'>".$recom_proj."</a></td></tr>";
		} 
		echo "</table>";
		// end recommendation system
	?>
	

	
	</body>
	<style>
	
	    #newproject{
			position:absolute;
			top:  50px;
			right:  750px;

			}
		#charge{
			position:absolute;
			top:  50px;
			right:  500px;

			}
		#edit{
			position:absolute;
			top:  50px;
			right:  350px;

			} 
		#logout{
			position:absolute;
			top:  50px;
			right:  50px;

			} 
		#acthistory{
			position:absolute;
			top:  50px;
			right:  200px;

			} 
		#mypro{
			position:absolute;
			top:  200px;
			right:  50px;

			} 
		#myfoll{
			position:absolute;
			top:  200px;
			right:  300px;

			} 
		#mylike{
			position:absolute;
			top:  200px;
			right:  550px;

			} 
		#sertable{
			 margin:2cm 0cm 2cm 0cm;

			} 
			
		#myrecom{
			position:absolute;
			top:  200px;
			right: 700px;

			} 
	</style>
</html>