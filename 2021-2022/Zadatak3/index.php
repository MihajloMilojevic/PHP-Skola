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
	<p>Osnovne aritmetičke operacije, tipovi podataka i ispis pomoću funkcija</p>
	<?php 

		function Zbir($a, $b){
			return $a + $b;
		}

		function Razlika($a, $b){
			return $a - $b;
		}

		function Proizvod($a, $b){
			return $a * $b;
		}

		function Kolicnik($a, $b){
			return $a / $b;
		}

		function Ostatak($a, $b){
			return $a % $b;
		}

		$a = 5;
		$b = 3;
		echo "a: ";
		var_dump($a);
		echo "<br>";
		echo "b: ";
		var_dump($b);
		echo "<br>";
		echo "$a + $b = " . Zbir($a, $b) . "  <br>"; 
		echo "$a - $b = " . Razlika($a, $b) . "  <br>"; 
		echo "$a * $b = " . Proizvod($a, $b) . "  <br>"; 
		echo "$a / $b = " . Kolicnik($a, $b) . "  <br>"; 
		echo "$a % $b = " . Ostatak($a, $b) . "  <br>"; 
	?>
</body>
</html>