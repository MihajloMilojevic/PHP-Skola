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
	<title>Zadatak 5 - Prikaz</title>
</head>
<body>
	<h1 class="title">Zadatak 5</h1>
	<p>Sesije</p>
	<a href="/">Početna</a>
	<div class="php">
		<?php 
			echo "<p> Zdravo, " . $_SESSION["user"]["ime"] . " " . $_SESSION["user"]["prezime"] . "</p>";
			echo "<p>Vreme pristupa:  " . $_SESSION["user"]["datum"] . "</p>"
		?>
	</div>
</body>
</html>