<?php
	ignore_user_abort();
	set_time_limit(0);
	$interval=60*60*24;
	$mysql_server_name="127.0.0.1:3306"; //server name
	$mysql_username="root"; // username
	$mysql_password="root"; // password
	$mysql_database="kickfounder"; // database name
	$con = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
	if ($con->connect_error) {
		die("Database connect_error: " . $con->connect_error);
		}
	    $sql_pledge_check1 = "UPDATE PROJECT SET projectstatus = 'succeed' 
            WHERE projectstatus='ongoing' AND
            NOW()>=endtime AND
            (SELECT SUM(amount) FROM PLEDGE WHERE PLEDGE.projectname=Project.projectname) >= Project.minfund";
        $sql_pledge_check2 = "UPDATE PROJECT SET projectstatus = 'failed' 
            WHERE projectstatus='ongoing' AND
            NOW()>=endtime AND
            (SELECT SUM(amount) FROM PLEDGE WHERE PLEDGE.projectname=Project.projectname) < Project.minfund";
	
	do{
	    mysqli_query($con, $sql_pledge_check1);
	    mysqli_query($con, $sql_pledge_check2);
		sleep($interval); 
    }while(true);
 
?>