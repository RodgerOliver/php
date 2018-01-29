<?php

	// set cookie
	// time() returns the current time in seconds
	// varName	value	time persistant
	setcookie("name", "Rodger", time() + 10);
	// this cookie will last 10 seconds
	echo $_COOKIE["name"];
	// to unset cookies
	// setcookie("name", "", time() - (60*60));

?>