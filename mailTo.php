<!DOCTYPE html>
<html>
<head>
	<title>Mail To...</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
</head>
<body>

	<?php
		include "makeHTML.php";
		$msg = '';
		$name = '';
		$email = '';
		$text = '';
		if($_SERVER["REQUEST_METHOD"] === "POST") {
			$name = $_POST["name"];
			$email = $_POST["email"];
			$text = $_POST["text"];
			$alert = "";
			if($name === "") {
				$alert .= "Name field is required!<br>";
			} elseif(!preg_match("/^[a-zA-Z'-]+$/",$name)) {
				$alert .= "Invalid name.<br>";
			}

			if($email === "") {
				$alert .= "Email field is required!<br>";
			} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$alert .= "Invalid email.<br>";
			}

			if($text === "") {
				$alert .= "Message field is required!<br>";
			}

			if($alert !== "") {
				$msg = makeHTML("div", "<strong>Something went wrong</strong><br>".$alert, ['class="alert alert-danger"', 'role="alert"']);
			} else {
				$emailTo = "timeline.mb@gmail.com";
				$subject = "Your Website Email";
				$body = "Name: ".$name."\n"."Message: ".$text;
				$headers = "From: ".$_POST['email'];

				if(mail($emailTo, $subject, $body, $headers)) {
					$str = "Your email was correctly sent! We will contact you soon ".$name.".";
					$msg = makeHTML("div", $str, ['class="alert alert-success"', 'role="alert"']);
				} else {
					$str = "Something went wrong, try to send later.";
					$msg = makeHTML("div", $str, ['class="alert alert-danger"', 'role="alert"']);
				}
			}

		}
	?>


	<div class="container my-4">
		<?php echo $msg; ?>
		<h1>Send A Email Via PHP</h1>
		<form method="POST">
			<fieldset class="form-group">
				<label for="name">Name</label>
				<input id="name" class="form-control" type="text" name="name" value="<?= $name ?>" placeholder="Name">
			</fieldset>
			<fieldset class="form-group">
				<label for="email">Email</label>
				<input id="email" class="form-control" type="text" name="email" value="<?= $email ?>" placeholder="Email">
			</fieldset>
			<fieldset class="form-group">
				<label for="body">Message</label>
				<textarea id="text" class="form-control" type="text" name="text" placeholder="Message" rows="5"><?= $text ?></textarea>
			</fieldset>
			<input class="btn btn-primary btn-lg" type="submit" value="Submit">
		</form>
	</div>

</body>
</html>