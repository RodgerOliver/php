<?php

	include "makeHTML.php";
	$link = mysqli_connect("127.0.0.1", "root", "Rodger120201", "usersdb");
	if(mysqli_connect_error()) {
		die("Database connection failed.");
	}
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST && $_POST["email"] && $_POST["password"]) {
			$email = mysqli_real_escape_string($link, $_POST["email"]);
			$password = mysqli_real_escape_string($link, $_POST["password"]);
			if(isset($_POST["login"])) {
				$query = "SELECT * FROM `users` WHERE `email`='".$email."' LIMIT 1";
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_array($result);
				if($row["email"] === $email) {
					$hash = $row["password"];
					if(password_verify($password, $hash)) {
						header("location: loggedIn.php");
					} else {
						$str = "Invalid password.";
						$msg = makeHTML("div", $str, array('class="alert alert-danger"', 'role="alert"'));
					}
				} else {
					$str = "You are not register yet.";
					$msg = makeHTML("div", $str, array('class="alert alert-danger"', 'role="alert"'));
				}
			} elseif(isset($_POST["signup"])) {
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$query = "SELECT * FROM `users` WHERE `email`='".$email."' LIMIT 1";
				$result = mysqli_query($link, $query);
				if($result->num_rows === 0) {
					$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".$email."', '".$hash."')";
					if(mysqli_query($link, $query)) {
						header("location: loggedIn.php");
					} else {
						$str = "You could not be registered, please try again later.";
						$msg = makeHTML("div", $str, array('class="alert alert-danger"', 'role="alert"'));
					}
				} else {
					$str = "You are resgistered, go to the Log In form.";
					$msg = makeHTML("div", $str, array('class="alert alert-danger"', 'role="alert"'));
				}
			}
		} else {
			$str = "Please fill all the fileds.";
			$msg = makeHTML("div", $str, array('class="alert alert-danger"', 'role="alert"'));
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Secret Dairy</title>
	<link rel="stylesheet" type="text/css" href="https://goo.gl/LLUD4L">
</head>
<body>

	<div class="container">
			<h1 class="mt-5">Log In</h1>
			<?php if(isset($msg)) {echo $msg;} ?>
			<form action="" method="POST">
				<fieldset class="form-group">
					<input class="form-control" type="email" name="email" placeholder="Your email">
				</fieldset>
				<fieldset class="form-group">
					<input class="form-control" type="password" name="password" placeholder="Your password">
				</fieldset>
				<fieldset class="form-check mb-3">
					<input id="stayLogin" class="form-check-input" type="checkbox" value="1" name="stayLogin">
					<label class="form-check-label" for="stayLogin">
						Stay Logged In
					</label>
				</fieldset>
				<fieldset class="form-group">
					<input class="btn btn-primary" type="submit" name="login" value="Log In">
				</fieldset>
			</form>

			<h1 class="mt-5">Sign Up</h1>
			<form action="" method="POST">
				<fieldset class="form-group">
					<input class="form-control" type="email" name="email" placeholder="Your email">
				</fieldset>
				<fieldset class="form-group">
					<input class="form-control" type="password" name="password" placeholder="Your password">
				</fieldset>
				<fieldset class="form-check mb-3">
					<input id="stayLogin" class="form-check-input" type="checkbox" value="1" name="stayLogin">
					<label class="form-check-label" for="stayLogin">
						Stay Logged In
					</label>
				</fieldset>
				<fieldset class="form-group">
					<input class="btn btn-primary" name="signup" type="submit" value="Sign Up">
				</fieldset>
			</form>
	</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>