<?php 
	session_start();
	require "./DATABASE/connection.php";
	$sql = "SELECT t.id, t.naziv, t.opis, DATE_FORMAT(t.datum, '%d.%m.%Y %H:%i:%s') as datum, k.ime, k.prezime 
	FROM teme t JOIN korisnici k ON t.autor_id = k.id 
	ORDER BY t.datum DESC";
	$res = $conn->query($sql);
	$teme = array();
	while($tema = $res->fetch_assoc()) array_push($teme, $tema);
?>

<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="./css/global.css">
	<title>Forum</title>
</head>
<body>
	<p><a href="./registracija.php">Registracija</a></p>
	<p><a href="./prijava.php">Prijava</a></p>
	<p><a href="./odjava.php">Odjava</a></p>
	<p><a href="./teme.php">Teme</a></p>
	<hr>
	<?php
		foreach ($teme as $tema) {
			echo "
				<div>
					<h3><a href='/diskusija.php?id=". $tema["id"] ."'>" . $tema["naziv"] ."</a></h3>
					<p>" . $tema["opis"] . "</p>
					<p>" . $tema["datum"] . " - " . $tema["ime"] . " " . $tema["prezime"] . "</p>
					<hr>
				</div>
			";
		}
	?>
</body>
	
</html>