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
	<p>Ispis elemenata niza povezanih zarezom, a poslednji pomoću 'i'</p>
	<div class="php">
	<?php 
		$niz = array("plava", "crvena", "zuta", "zelena");
		echo join(", ", array_slice($niz, 0, count($niz) - 1)) . " i " . $niz[count($niz) - 1];
	?>
	</div>
</body>
</html>