<?php
	
	session_start();
	include "../makeHTML.php";
	$link = mysqli_connect("127.0.0.1", "root", "Rodger120201", "usersdb");
	if(mysqli_connect_error()) {
		die("Database connection failed.");
	}

	// check logout
	if(isset($_GET["logout"])) {
		if ($_GET["logout"] === "1") {
			session_unset();
			setcookie("id", "", time() - (3600));
			$_COOKIE["id"] = "";
		}
		// cannot access this page if logged in
	} elseif(isset($_SESSION["id"]) || isset($_COOKIE["id"])) {
		header("location: loggedIn.php");
	}
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST && $_POST["email"] && $_POST["password"]) {
			// escape the inputs
			$email = mysqli_real_escape_string($link, $_POST["email"]);
			$password = mysqli_real_escape_string($link, $_POST["password"]);
			// if LOGIN
			if(isset($_POST["login"])) {
				$query = "SELECT * FROM `users` WHERE `email`='".$email."' LIMIT 1";
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_array($result);
				// if email matches
				if($row["email"] === $email) {
					$hash = $row["password"];
					// if password matches
					if(password_verify($password, $hash)) {
						// set session
						$_SESSION["id"] = $row["id"];
						// if want to stay logged in
						if(isset($_POST["stayLogin"])) {
							if ($_POST["stayLogin"] === "1") {
								// set cookie for 1 hour
								setcookie("id", mysqli_insert_id($link), time() + 3600);
							}
						}
						// redirect
						header("location: loggedIn.php");
					} else {
						$str = "Invalid email or password.";
						$msg = makeHTML("div", $str, array('class="alert alert-danger"', 'role="alert"'));
					}
				} else {
					$str = "You are not register yet.";
					$msg = makeHTML("div", $str, array('class="alert alert-danger"', 'role="alert"'));
				}
				// if SING UP
			} elseif(isset($_POST["signup"])) {
				// hash password
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$query = "SELECT * FROM `users` WHERE `email`='".$email."' LIMIT 1";
				$result = mysqli_query($link, $query);
				// if user is not registered
				if($result->num_rows === 0) {
					$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".$email."', '".$hash."')";
					// if registered
					if(mysqli_query($link, $query)) {
						// set session
						$_SESSION["id"] = mysqli_insert_id($link);
						// if want to stay logged in
						if($_POST["stayLogin"] === "on") {
							// set cookie
							setcookie("id", mysqli_insert_id($link), time() + 3600);
						}
						// redirect
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