<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	<title>Zadatak 6</title>
</head>
<body>
	<h1 class="title">Zadatak 6</h1>
	<p>
		Rad sa nizovima <br>
	</p>
	
	<div class="php">
	<?php 
		$imena = array(
			"Sara",
			"Mihajlo",
			"Stefan",
			"Nikola",
			"Vukašin",
			"Nikola",
			"Sara",
			"Strahinja",
			"Vojin"
		);
		$nadimci = array(
			"Sara S" => "Caaajjaaa",
			"Mihajlo M" => "Miči",
			"Stefan P" => "Pali",
			"Nikola R" => "Rogonja",
			"Vukašin R" => "Riznić",
			"Nikola O" => "Obrad",
			"Sara M" => "Sara",
			"Strahinja S" => "Majdza",
			"Vojin Š" => "Šuki"
		);
		$tabela = array(
			array("Sara", "Spasojevic", "BTS"),
			array("Stefan", "Pejkovic", "nerviranje ostalih"),
			array("Nikola", "Rogonjic", "teretana"),
			array("Nikola", "Obradovic", "fudbal")
		);
		function Ispis($niz){
			echo "<span class='niz'>Niz: " . join(", ", $niz) . "</span><br>";
		}
		
		Ispis($imena);
		echo "Dužina niza: " . count($imena) . "<br>";
		Ispis($imena);
		echo "Peti član niza niza: " . $imena[4] . "<br>";
		Ispis($imena);
		$imena[count($imena)] = "Nikola";
		echo "Nikola dodat<br>";
		Ispis($imena);
		sort($imena);
		echo "Niz sortiran <br>";
		Ispis($imena);
		shuffle($imena);
		echo "Niz izmešan<br>";
		Ispis($imena);
		
		echo "<br><br>";


		Ispis($nadimci);
		echo "Dužina niza: " . count($nadimci) . "<br>";
		Ispis($nadimci);
		echo "Peti član niza niza: " . $nadimci["Vukašin R"] . "<br>";
		Ispis($nadimci);
		$nadimci["Nikola M"] = "Džoni";
		echo "Nikola dodat<br>";
		Ispis($nadimci);
		sort($nadimci);
		echo "Niz sortiran <br>";
		Ispis($nadimci);
		shuffle($nadimci);
		echo "Niz izmešan<br>";
		Ispis($nadimci);
	?>
	</div>
	<br>
	<div class="php">
		<table>
			<thead>
				<tr>
					<th>Ime</th>
					<th>Prezime</th>
					<th>Hobi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					for($i = 0; $i < count($tabela); $i++)
					{
						echo "<tr>";
						for($j = 0; $j < count($tabela[$i]); $j++)
							echo "<td>" . $tabela[$i][$j] . "</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>