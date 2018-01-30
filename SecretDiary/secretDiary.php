<?php
	
	session_start();
	include "../makeHTML.php";
	$link = mysqli_connect("127.0.0.1", "root", "Rodger120201", "usersdb");
	if(mysqli_connect_error()) {
		die("Database connection failed.");
	}

	if(isset($_GET["logout"])) {
		if ($_GET["logout"] === "1") {
			session_unset();
			setcookie("id", "", time() - (3600));
			$_COOKIE["id"] = "";
		}
	} elseif(isset($_SESSION["id"]) || isset($_COOKIE["id"])) {
		header("location: loggedIn.php");
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
						$_SESSION["id"] = $row["id"];
						if(isset($_POST["stayLogin"])) {
							if ($_POST["stayLogin"] === "1") {
								setcookie("id", mysqli_insert_id($link), time() + 3600);
							}
						}
						header("location: loggedIn.php");
					} else {
						$str = "Invalid email or password.";
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
						$_SESSION["id"] = mysqli_insert_id($link);
						if($_POST["stayLogin"] === "on") {
							setcookie("id", mysqli_insert_id($link), time() + 3600);
						}
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
	<style type="text/css">

		html {
			background: url("https://goo.gl/Ej2woq") no-repeat center center fixed;
			background-size: cover;
			height: 100%;
			width: 100%;
			display: flex;
			align-items: center;
		}

		body {
			background: none;
			margin: 0 auto;
		}

		.form-control {
			width: 400px;
			margin: 0 auto;
			text-align: center;
		}

		.container {
			color: #fff;
			text-shadow: 9px 6px 15px #000;
		}

		#toggleForm {
			font-weight: bold;
			color: #afffaf;
		}

		#toggleForm:hover {
			text-decoration: underline;
			color: #2be62b;
		}

		.signup {
			display: none;
		}

		.alert {
			text-shadow: none;
		}

	</style>
</head>
<body>

	<div class="container text-center">
		<h1 class="mb-3">Secret Dairy</h1>
		<p class="font-weight-bold">Store your thoughts permanently and securely.</p>
		<p class="login">Log in using your username and password.</p>
		<p class="signup">Interested? Sign up now.</p>
		<?php if(isset($msg)) {echo $msg;} ?>
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
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
				<fieldset class="form-group login">
					<input class="btn btn-primary" type="submit" name="login" value="Log In">
				</fieldset>
				<fieldset class="form-group signup">
					<input class="btn btn-primary" name="signup" type="submit" value="Sign Up">
				</fieldset>
				<p><a id="toggleForm">Sign Up</a></p>
			</form>
	</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script>

	$("#toggleForm").click(function() {
		$(".signup").toggle();
		$(".login").toggle();
		if($(".login").css("display") !== "none") {
			$("#toggleForm").text("Sign Up");
		} else {
			$("#toggleForm").text("Log In");
		}
	});

</script>
</body>
</html>