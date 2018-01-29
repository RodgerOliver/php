<?php

	// mysqli() vs mysql()
	// server	username	password	dbName
	$link = mysqli_connect("shareddb-f.hosting.stackcp.net", "usersDB-323604c5", "Rodger120201", "usersDB-323604c5");
	if(mysqli_connect_error()) {
		die("Error connecting to the database");
	} else {
		echo "Database connection established";
	}
/* MAKE QUERY */
	// $query = "INSERT INTO `users` (`email`, `password`) VALUES('parkour@awesome.com', 'parkour')";
	// $query = "UPDATE `users` SET email='rodgerbittencourt@gmail.com' WHERE ID=2 LIMIT 1";
/* RUN QUERY */
	// mysqli_query($link, $query);


	// $query = "SELECT * FROM `users`";
	// $query = "SELECT * FROM `users` WHERE email LIKE '%@%'"; // % means anything
	// $query = "SELECT email FROM `users` WHERE ID>=2 AND email LIKE '%A%'";
	// $name = "Rodger o\'Grady";
	// $query = "SELECT * FROM `users` WHERE name='".$name."'";
	$name = "Rodger o'Grady";
	$query = "SELECT * FROM `users` WHERE name='".mysqli_real_escape_string($link, $name)."'";
	echo "<br>";
	/* RUN QUERY */
	$result = mysqli_query($link, $query);
	if($result) {
		echo "Query was succsessful<br>";
		while($row = mysqli_fetch_array($result)) {
			print_r($row);
		}
		// echo "Your email is ". $row["email"]."<br>";
		// echo "Your password is ". $row["password"];
	} else {
		echo "Query didn't work";
	}

?>