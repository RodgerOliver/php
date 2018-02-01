<?php

	session_start();
	$diary = '';
	$link = mysqli_connect("127.0.0.1", "root", "Rodger120201", "usersdb");
	if(mysqli_connect_error()) {
		die("Database connection failed.");
	}
	// if cookie set session
	if(isset($_COOKIE["id"])) {
		$_SESSION["id"] = $_COOKIE["id"];
	}
	// if session
	if(isset($_SESSION["id"])) {
		// logout btn
		$logoutLink = '<form action="index.php" method="POST"><input class="btn btn-success-outline" type="submit" name="logout" value="Log Out"></form>';
		$id = $_SESSION["id"];
		// select diary of the user
		$query = "SELECT `diary` FROM `users` WHERE `id`='".$id."' LIMIT 1";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
		$diary = $row["diary"];
	} else {
		// if no session or cookie, redirect
		header("location: index.php");
	}

?>