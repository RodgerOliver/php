<!DOCTYPE html>
<html>
<head>
	<title>Php in server</title>
</head>
<body>

	<h1>Hello</h1>

	<?php

		// declaring variables
		$myVar = "World";
		$name = "Rodger";
		$calc = 45*8-9/"10";
		// concatnating
		echo $myVar." ".$name;
		echo "<br>"."The result of the calculation is ".$calc;
		//declaring constants
		define("FOO", "bar"); // last param: casa-sentive, default false;
		echo "<br>".FOO;
		// variable scope
		function displayName() {
			global $name;
			echo "<br>".$name;
		}
		displayName();
		// array
		$arr = array("Rodger", "Ingrid", "Marcio", "Regiane");
		echo "<br>";
		// print array
		print_r($arr);
		// loops
		for($i = 0; $i<sizeof($arr); $i++) {
			echo "<br>With the for loop ".$arr[$i];
		}
		echo "<br>";
		foreach($arr as $key => $value) {
			echo $value." is the number ".$key."<br>";
		}
		echo "<br>";
		$j = 0;
		while($j <= 10) {
			echo "<br>".$j*5;
			$j++;
		}
		echo "<br>";
		// condicional
		if($name === "Rodger") {
			echo $name." is programming in PHP";
		} elseif ($name === "Roger") {
			echo $name." is programming in JavaScript";
		} else {
			echo $name." is not programming";
		}
		// objects
		class js {
			function alert($string="alert('Hello World from PHP')") {
				echo "<script type='text/javascript'>alert('".$string."')</script>";
			}
			function prompt($string) {
				echo "<script type='text/javascript'>var answer = prompt('".$string."')</script>";
				$type = "<script type='text/javascript'>document.write(answer)</script>";
				return $type;
			}
		}
		echo "<br>";
		$jas = new js;
		$num = $jas->prompt("Type a number");
		echo $num;

	?>

</body>
</html>