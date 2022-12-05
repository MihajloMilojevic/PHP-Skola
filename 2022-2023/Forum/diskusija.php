<?php 
	session_start();
	if(empty($_GET["id"])) {
		header("location: /error.php?code=404&message=" . urlencode("Tema ne postoji"));
		exit();
	}
	require "./DATABASE/connection.php";
	function fetchTema() {
		require "./DATABASE/connection.php";
		$sql = "SELECT json FROM json_teme WHERE id = '" . $_GET["id"] ."'";
		$res = $conn->query($sql);
		if($res->num_rows == 0) {
			header("location: /error.php?code=404&message=" . urlencode("Tema sa id-jem " . $_GET["id"] . " ne postoji"));
			exit();
		}
		return json_decode(($res->fetch_assoc())["json"]);
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$tema = fetchTema();
	$data = array(
		"tekst" => array(
			"value" => "",
			"errorMessage" => "",
			"ok" => true
		),
		"errorMessage" => "",
		"ok" => true
	);

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty($_SESSION["korisnik"])) {
			$data["ok"] = false;
			$data["errorMessage"] = "Samo ulogovani korinsnici kogu da ostavljaju komentare.";
		}
		else if(empty($_POST["tekst"])) {
			$data["tekst"]["errorMessage"] = "Morate uneti komentar";
			$data["tekst"]["ok"] = false;
		}
		else {
			$data["tekst"]["value"] = test_input($_POST["tekst"]);
			$sql = "INSERT INTO komentari(tekst, autor_id, tema_id) 
					VALUES('" . $data["tekst"]["value"] . "', '" . $_SESSION["korisnik"]["id"] . "', '" . $tema->id . "')";
			$res = $conn->query($sql);
			$tema = fetchTema();
		}
	}

?>
<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="./css/global.css">
	<title><?php
		echo $tema->naziv;
	?></title>
</head>
<body>
	
	<p><a href="/">Nazad na početnu</a></p>
	<h1><?php
		echo $tema->naziv;
	?></h1>
	<p>
		<?php
			echo $tema->opis;
		?>
	</p>
	<?php 
		if(!empty($tema->komentari)) {
			foreach ($tema->komentari as $komentar) {
				echo "<p>" . $komentar->autor->ime . " " . $komentar->autor->prezime . " - " . $komentar->datum . "</p>";
				echo "<p>" . $komentar->tekst . "</p>";
				echo "<hr>";
			}
		}
	?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $_GET["id"]; ?>" method="post">
		
		<label for="tekst">Dodajte komentar:</label>
		<textarea type="text" name="tekst" id="tekst" value="<?php echo $data["tekst"]["value"] ?>"></textarea> 
		<?php if(!($data["tekst"]["ok"])) echo "<p class='error'>" . $data["tekst"]["errorMessage"] . "</p>"; ?>
		
		<button type="submit">Dodaj</button>

	</form>
</body>
</html>