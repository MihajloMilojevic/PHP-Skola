<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "milojevic";
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
		echo "Greska pri povezivanju s bazom";
		die("Connection failed: " . $conn->connect_error);
	}

?>