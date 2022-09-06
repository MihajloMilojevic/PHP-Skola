<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="./styles.css">
	<title>Zadatak 2</title>
</head>
<body>
	<h1 class="title">Zadatak 2</h1>
	<p>
		Funkcije za rad sa stringovima <br>
		U mala slova: "strtolower(string)" <br>
		U veliika slova: "strtoupper(string)" <br>
		Broj karaktera: "strlen(string)" <br>
		Zamena: "str_replace(what, with, string)"
	</p>
	<div class="php">
	<?php 
		$x = "Zdravo Svete";
		echo "<p>Originalni string: \"$x\" <br></p>";
		echo "<p>Malim slovima: \"" . strtolower($x) . "\"</p>";
		echo "<p>Velikim slovima: \"" . strtoupper($x) . "\"</p>";
		echo "<p>Broj karaktera: \"" . strlen($x) . "\"</p> ";
		echo "<p>\"Svete\" zamenjen za \"Razrede\": \"" . str_replace("Svete", "Razrede", $x) . "\"</p>";
	?>
	</div>
</body>
</html>