<?php

	// start session
	session_start();
	// configure the db connection var
	// server	username	password	dbName
	$link = mysqli_connect("177.185.176.139", "usersDB-323604c5", "Rodger120201", "usersDB-323604c5");
	// hand error connection to db
	if(mysqli_connect_error()) {
		die("Error connecting to the database");
	} else {
		if(isset($_POST["email"]) && isset($_POST["password"])) {
			// format the inputs
			$email = mysqli_real_escape_string($link, $_POST["email"]);
			$password = mysqli_real_escape_string($link, $_POST["password"]);
			// make query
			$query = "SELECT * FROM `users` WHERE email='".$email."'";
			// run query
			$result = mysqli_query($link, $query);
			$row = mysqli_fetch_array($result);
			// check if user is registered
			if($row) {
				echo "You are already registered";
			} else {
				// make query
				$query = "INSERT INTO `users` (email, password) VALUES ('".$email."', '".$password."')";
				// run query and verify the completion
				if(mysqli_query($link, $query)) {
					// setup the session vars
					$_SESSION["email"] = $email;
					$_SESSION["password"] = $password;
					// redirect
					header("location: SESSION.php");
				} else {
					echo "Sorry, we could not resgister you";
				}
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Form</title>
	<link rel="stylesheet" href="https://goo.gl/LLUD4L">
</head>
<body>

	<div class="container my-4">
		<h1 class="my-3">Sign Up Form</h1>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
			<fieldset class="form-group">
				<input class="form-control" type="email" name="email" placeholder="Email" required>
			</fieldset>
			<fieldset class="form-group">
				<input class="form-control" type="password" name="password" placeholder="Password" required>
			</fieldset>
			<input class="btn btn-primary" type="submit" value="Send">
		</form>
	</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>