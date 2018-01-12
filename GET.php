<!DOCTYPE html>
<html>
<head>
	<title>Predifened Variables</title>
</head>
<body>

	<?php
		if($_GET && $_GET["num"] && is_numeric($_GET["num"]) && $_GET["num"] > 0 && $_GET["num"] == round($_GET["num"], 0)) {
			$num = $_GET["num"];
			if($num == 2) {
				echo $num." is not prime.";
			} elseif($num == 1) {
				echo $num." is a prime number!";
			} else {
				for ($i=2; $i<$num; $i++) { 
					if($num % $i === 0) {
						echo $num." is not prime.";
						break;
					} else {
						echo $num." is a prime number!";
						break;
					}
				}
			}
		} else {
			echo "Please type a positive whole number.";
		}
	?>

	<p>Is it prime?</p>
	<form>
		<input type="text" name="num" placeholder="Try a Number">		
		<input type="submit" value="Test">
	</form>

</body>
</html>