<!DOCTYPE html>
<html>
	<body>
	<?php
	    session_start();
		echo "<h1>User Home: ".$_SESSION['loginname']."</h1>";
		$mysql_server_name="127.0.0.1:3306"; //server name
		$mysql_username="root"; // username
		$mysql_password="root"; // password
		$mysql_database="kickfounder"; // database name
		$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
		if ($con->connect_error) {
			die("Database connect_error: " . $con->connect_error);
		}
		
		
		
		echo "<p><a href=\"./newproject.php\"><input type=\"button\" value=\"Create New Projects\"></input></a></p>";
		echo "<p><a href=\"./charge.php\"><input type=\"button\" value=\"Go to my charge record\"></input></a></p>";
		echo "<p><a href=\"./useredit.php\"><input type=\"button\" value=\"Edit My Profile\"></input></a></p>";
		echo "<p><a href=\"./logout.php\"><input type=\"button\" value=\"Log Out\"></input></a></p>";
		echo "<p><a href=\"./acthistory.php\"><input type=\"button\" value=\"Activity History\"></input></a></p>";
		echo "<form action='browse.php' method='post' id='sertable'>";
		echo "<p>Keyword: <input type='text' name='keyword'></p>";
		echo "<p><input type='submit' value='Develop!',name='find'></p>";
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
		echo "</table>";
		// Pledge List
		$pledge_sql = "SELECT * FROM PLEDGE WHERE loginname=\"".$_SESSION['loginname']."\"";
		$pledge_result = $con->query($pledge_sql);
		echo "<p>My PLEDGE:</p>";
		echo "<table id='myple'><tr> <th>Project</th> <th>Founder</th> <th>Pledge Time</th><th>Amount</th></tr>";
		if ($pledge_result->num_rows > 0) {
			while($row = $pledge_result->fetch_assoc()) {
				echo "<tr>";
				echo "<td><p><a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p></td>";
				echo "<td><p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["loginname"]."</a></p></td>";
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
        SELECT bfname FROM FOLLOW WHERE fname=\"".$_SESSION['loginname']."\")";
		$act_sql2 = "SELECT *
    FROM PROJECT, `USER` WHERE USER.loginname=PROJECT.loginname AND USER.loginname IN (
        SELECT bfname FROM FOLLOW WHERE fname=\"".$_SESSION['loginname']."\")";
		$act_sql3 = "SELECT *
	FROM PLEDGE, `USER` WHERE USER.loginname=PLEDGE.loginname AND USER.loginname IN (
        SELECT bfname FROM FOLLOW WHERE fname=\"".$_SESSION['loginname']."\")";
		$act_result1 = $con->query($act_sql1);
		$act_result2 = $con->query($act_sql2);
		$act_result3 = $con->query($act_sql3);
		echo "<p>My Follow News</p>";
		if ($act_result1->num_rows > 0) {
			while($row = $act_result1->fetch_assoc()) {
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> comment <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		if ($act_result2->num_rows > 0) {
			while($row = $act_result2->fetch_assoc()) {
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> create Project: <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
		if ($act_result3->num_rows > 0) {
			while($row = $act_result3->fetch_assoc()) {
				echo "<p><a href='userpage.php?uloginname=".$row["loginname"]."'>".$row["username"]."</a> pledge <a href='displayproject.php?projectname=".$row["projectname"]."'>".$row["projectname"]."</a></p>";
			}
		}
	?>
	
	<?php
	    // recommendation system
		// gather data for usr interested project_result
		// follow
		$pledge_sql = "SELECT * FROM USERACT WHERE loginname=\"".$_SESSION['loginname']."\"";
		$pledge_result = $con->query($pledge_sql);
		
		// pledge
		$pledge_sql = "SELECT * FROM PLEDGE WHERE loginname=\"".$_SESSION['loginname']."\"";
		$pledge_result = $con->query($pledge_sql);
		
		
		// use hashtable to store key
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	?>
	
	
	
	
	
	
	
	
	</body>
	<style>
		#mypro{
			position:absolute;
			top:  100px;
			right:  50px;

			} 
		#myfoll{
			position:absolute;
			top:  100px;
			right:  300px;

			} 
		#mylike{
			position:absolute;
			top:  100px;
			right:  550px;

			} 
		#sertable{
			position:absolute;
			top:  100px;
			left:  350px;

			} 
	</style>
</html>