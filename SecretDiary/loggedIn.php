<?php

	session_start();
	if(isset($_COOKIE["id"])) {
		$_SESION["id"] = $_COOKIE["id"];
	}
	if(isset($_SESSION["id"])) {
		echo "<p>Logged In <a href='secretDiary.php?logout=1'>Log Out</a></p>";
	} else {
		header("location: secretDiary.php");
	}

?>