<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	<title>Zadatak 1</title>
</head>
<body>
	<?php 
		$redovi = 0;
		$kolone = 0;
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			if(!empty($_GET["redovi"])) {
				$redovi = $_GET["redovi"];
			}
			if(!empty($_GET["kolone"])) {
				$kolone = $_GET["kolone"];
			}
		}
	?>
	<h1 class="title">Zadatak 2</h1>
	<p></p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="GET">
		<label for="br-red">Broj redova: </label>
		<input type="number" id="br-red" name="redovi" value="<?php echo $redovi; ?>"> <br>
		<label for="br-kol">Broj kolona: </label>
		<input type="number" id="br-kol" name="kolone" value="<?php echo $kolone; ?>"> <br>
		<button type="submit">Kreiraj tabelu</button>
	</form>
	<div class="php">
		<table>
			<tbody>
				<?php 
					for($i = 0; $i < $redovi; $i++) {
						if($i % 2 == 0)
							echo "<tr style='background: rgb(200, 200, 200)'>";
						else
							echo "<tr style='background: white'>";
						
						for($j = 0; $j < $kolone; $j++) {
							echo "<td>" . $i + 1 . " - " . $j + 1 . "</td>";
						}
						
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>