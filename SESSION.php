<?php

	// always start the session in the pages that uses it 
	session_start();
	if(isset($_SESSION["email"]) && isset($_SESSION["password"]) && isset($_SESSION["name"])) {
		$name = $_SESSION["name"];
		$email = $_SESSION["email"];
		$password = $_SESSION["password"];
	} else {
		// redirect
		header("location: signUpForm.php");
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>
<body>

	<h1>Congratulations!!</h1>
	<h2>You are Registered and Redirected</h2>
	<h3>Name: <?php echo $name; ?></h3>
	<h3>Email: <?php echo $email; ?></h3>
	<h3>Password: <?php echo $password; ?></h3>

</body>
</html>