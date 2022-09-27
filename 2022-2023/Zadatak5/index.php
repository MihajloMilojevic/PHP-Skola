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
	<title>Zadatak 5</title>
</head>
<body>
	<?php 
		$_SESSION["user"] = array("ime" => "Mihajlo", "prezime" => "Milojević", "datum" => (date("d.m.y h:i:s")));
	?>
	<h1 class="title">Zadatak 5</h1>
	<p>Sesije</p>
	<a href="./prikaz.php">Prikaz</a>
</body>
</html>