<?php 
session_start();

?>

<!DOCTYPE html>
<html>
<body>

Welcome <?php echo $_SESSION["loginname"]; ?><br>
Start your new project here.<br><br />

<form action="createproject.php" method="post">
 <fieldset>
  <legend>Project information:</legend>
    <input type="hidden" name="loginname" value="<?php echo $_SESSION['loginname']; ?>">
    Project Name: <input type="text" name="projectname" required><br>
    Description: <input type="textaera" name="description" required><br>
    Expected Fund:<br>
    Minimum: <input type="number" name="minfund" min=1>
    Maximum: <input type="number" name="maxfund" min=1> <br>
    Time Schedule:<br>
    Pledge Endtime: <input type="date" name="pledgetime"><br>
    Project Endtime: <input type="date" name="plantime"><br>
 </fieldset>
<input type="submit" value="Submit Project">
</form>

</body>
</html>
