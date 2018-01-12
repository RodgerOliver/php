<!DOCTYPE html>
<html>
<head>
	<title>Predifened Variables</title>
</head>
<body>

	<?php
		if($_SERVER["REQUEST_METHOD"] === 'POST') {
			if($_POST && $_POST["name"]) {
				$known = array("Rodger", "Ingrid", "Marcio", "Regiane");
				$name = $_POST["name"];
				$isKnown = false;
				foreach ($known as $value) {
					if(strtolower($name) === strtolower($value)) {
						$isKnown = true;
					}
				}
				if($isKnown) {
					echo "<p>Welcome <strong>".ucfirst($name)."!!</strong></p>";
				} else {
					echo "<p>Sorry, I don't know you <strong>".ucfirst($name).".</strong></p>";
				}
			} else {
				echo "<p>Param not valid<p>";
			}
		}

	?>

	<p>Do I know you?</p>
	<form method="POST">
		<input type="text" name="name" placeholder="Type a name">		
		<input type="submit" value="Test">
	</form>

</body>
</html>