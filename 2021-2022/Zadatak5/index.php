<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="./styles.css">
	<title>Zadatak 5</title>
</head>
<body>
	<h1 class="title">Zadatak 5</h1>
	<p>
		Rad sa datumima <br>
		funkcija "date(format)" <br>
		<a href="https://www.w3schools.com/php/func_date_date.asp" target="_blank">W3 - opcije formata</a>
	</p>
	
	<div class="php">
	<?php 
		echo "<p> &copy;" . date("Y") . "</p>";
		echo "<p> Trenutni datum: " . date("d.m.Y.") . "</p>";
		echo "<p> Trenutno vreme: " . date("H:i:s") . "</p>";
		$vreme = intval(date("H"));
		$poruka = "Laku noć";
		if($vreme >= 6 && $vreme < 10)
			$poruka = "Dobro jutro";
		else if($vreme >= 10 && $vreme < 18)
			$poruka = "Dobar dan";
		else if($vreme >= 18 && $vreme < 23)
			$poruka = "Dobro veče";
		echo "<p>$poruka</p>";
		$kraj = date_create("24.6.2022. 19:30");
		$sad = date_create();
		echo "Do kraja školske godine je ostalo još: <br>" . 
			date_diff($kraj, $sad)->format("%m meseci %d dana %h sati %i minuta %s sekundi");
	?>
	</div>
</body>
</html>