<?php

	session_start();
	$link = mysqli_connect("127.0.0.1", "root", "Rodger120201", "usersdb");
	if(mysqli_connect_error()) {
		die("Database connection failed.");
	}
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		// if content from ajax and logged in
		if(isset($_POST["content"]) && isset($_SESSION["id"])) {
			$id = $_SESSION["id"];
			// update the database
			$data = mysqli_real_escape_string($link, $_POST["content"]);
			$query = "UPDATE `users` SET `diary`='".$data."' WHERE `id`='".$id."' LIMIT 1";
			mysqli_query($link, $query);
		}
	}
	
?>