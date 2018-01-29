<?php

	// hash the password
	$password = "mypassword";
	$hash = md5($password);
	echo $hash;

	// =========================

	echo "<br>";
	// hash the password with static salt
	$salt = "yhbsrvdf@#$%465685";
	$hash = md5($salt.$password);
	echo $hash;

	// =========================

	echo "<br>";
	// hash the password with random salt
	$row["id"] = 5;
	$salt = $row["id"];
	$hash = md5(md5($salt).$password);
	echo $hash;

	// =========================

	echo "<br>";
	// Generate a hash of the password "mypassword"
	$hash = password_hash($password, PASSWORD_DEFAULT);
	echo $hash;
	echo "<br>";
	// using password_verify() to check if "mypassword" matches the hash
	if (password_verify('mypassword', $hash)) {
		echo 'Password is valid!';
	} else {
		echo 'Invalid password.';
	}

?>