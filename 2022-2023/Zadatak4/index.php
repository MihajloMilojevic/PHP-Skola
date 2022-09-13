<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	<title>Zadatak 4</title>
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
	<h1 class="title">Zadatak 4</h1>
	<p></p>
	<div class="php">
		<?php 
			
			function najcesce($niz) {
				$broj = array();
				$max = 0;
				// foreach ($niz as $value) {
				for($i = 0; $i < count($niz); $i++) {
					$kljuc = strval($niz[$i]);
					if(!array_key_exists($kljuc, $broj)) 
						$broj[$kljuc] = 0;
					$broj[$kljuc]++;
					if($max < $broj[$kljuc]) 
						$max = $broj[$kljuc];
				}
				foreach ($broj as $key => $value) {
					if($value == $max)
						return $key;
				}
			}

			$niz = array("test", "abc", 1, 5, "m", 5, "kk", "ok", 3, "5");
			echo "<p>Niz: ". implode(", ", $niz) . "</p>";
			echo "<p>Najčešći: " . najcesce($niz) . "</p>";
		?>
	</div>
</body>
</html>