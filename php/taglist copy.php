
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<style>
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
<body>

<?php
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
?>

</body>

</html>
