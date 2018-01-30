<?php include "indexPHP.php"; ?>

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
			cursor: pointer;
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
				<fieldset class="form-group">
					<input class="btn btn-primary" type="submit" name="login" value="Log In">
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
			$("input[type='submit']").attr("value", "Log In");
			$("input[type='submit']").attr("name", "login");
			$("#toggleForm").text("Sign Up");
		} else {
			$("input[type='submit']").attr("value", "Sign Up");
			$("input[type='submit']").attr("name", "signup");
			$("#toggleForm").text("Log In");
		}
	});

</script>
</body>
</html>