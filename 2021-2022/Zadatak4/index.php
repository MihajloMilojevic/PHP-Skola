<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="./styles.css">
	<title>Zadatak 4</title>
</head>
<body>
	<h1 class="title">Zadatak 4</h1>
	<p>
		Izračunavnje obima i površine pravougaonika pomoću funkcije sa parametrima
	</p>
	<form action="/" method="get">
		<label for="a">a: </label>
		<input id="a" type="number" name="a" placeholder="a"> <br>
		<label for="b">b: </label>
		<input id="b" type="number" name="b" placeholder="b"> <br>
		<input type="submit" value="Izracunaj">
	</form>
	<div class="php">
	<?php 
		if(isset($_GET["a"]) && !empty($_GET["a"]) && isset($_GET["b"]) && !empty($_GET["b"])) {
			$a = $_GET["a"];
			$b = $_GET["b"];
			echo "<p>a: " . $a . "</p>";
			echo "<p>b: " . $b . "</p>";
			echo "<p>Obim: " . Obim($a, $b) . "</p>";
			echo "<p>Površina: " . Povrsina($a, $b) . "</p>";
		}

		function Obim($a, $b) {
			return 2 * ($a + $b);
		}

		function Povrsina($a, $b) {
			return $a * $b;
		}
	?>
	</div>
</body>
</html>