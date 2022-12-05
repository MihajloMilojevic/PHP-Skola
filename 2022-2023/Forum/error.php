<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/global.css">
	<title>Greška</title>
</head>
<body>
	<p><a href="/">Nazad na početnu</a></p>
	<h1><?php
		if(empty($_GET["code"])) echo "500";
		else echo $_GET["code"];
	?></h1>
	<p><?php
		if(empty($_GET["message"])) echo "Došlo je do greške";
		else echo $_GET["message"];
	?></p>
</body>
</html>