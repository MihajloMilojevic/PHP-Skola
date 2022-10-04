<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	<title>Zadatak 6 | Lista</title>
</head>
<body>
	<?php 
		if(!isset($_SESSION["proizvodi"]))
			$_SESSION["proizvodi"] = array();
	?>
	<h1 class="title">Zadatak 6 - Vaš izbor</h1>
	<p>Sesije 2</p>
	
	<?php
		if(count($_SESSION["proizvodi"]) > 0) {
			echo "<ul>";
			foreach($_SESSION["proizvodi"] as $proizvod) 
				echo "<li>" . $proizvod . "</li>";
			echo "</ul>";
		}
		else {
			echo "<p>Niste odabrali ni jedan proizvod</p>";
		}
	?>
	<a href="/">Izaberi još</a>
</html>