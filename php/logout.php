<!DOCTYPE html>
<html>
	<body>
	<h1>Successfully logout</h1>
	<?php
        session_start();	
		session_destroy();
		setcookie("user", "", time()-3600);
		echo "<p><a href=\"./index.php\"><input type=\"button\" value=\"Back to the Login page!\"></input></a></p>";
	?>
	</body>
</html>