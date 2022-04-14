<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="styles.css">
	<title>Zadatak 1</title>
</head>
<body>
	<h1 class="title">Zadatak 1</h1>
	<p>Osnovne aritmetičke operacije, tipovi podataka i ispis</p>
	<div class="php">
	<?php 

		$a = 5;
		$b = 3;
		echo "<p>a: ";
		var_dump($a);
		echo "</p>";
		echo "<p>b: ";
		var_dump($b);
		echo "</p>";
		echo "<p>$a + $b = " . $a + $b . " </p>"; 
		echo "<p>$a - $b = " . $a - $b . " </p>"; 
		echo "<p>$a * $b = " . $a * $b . " </p>"; 
		echo "<p>$a / $b = " . $a / $b . " </p>"; 
		echo "<p>$a % $b = " . $a % $b . " </p>"; 
	?>
	</div>
</body>
</html>