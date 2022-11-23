<?php 
	session_start();
	if (empty($_SESSION["korisnik"])) {
		header("location: /error.php?code=401&message=" . urlencode("Samo ulogovani korisnici mogu kreirati teme"));
	}
	require "./DATABASE/connection.php";
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }

	$data = array(
		"naziv" => array(
			"value" => "",
			"errorMessage" => "",
			"ok" => true
		),
		"opis" => array(
			"value" => "",
			"errorMessage" => "",
			"ok" => true
		),
		"errorMessage" => "",
		"ok" => true
	);
	
	function proveraNaziva($vrednost) {
		$naziv = array("value" => $vrednost, "errorMessage" => "", "ok" => true);
		if(empty($vrednost)) {
			$naziv["errorMessage"] = "Morate uneti naziv";
			$naziv["ok"] = false;
			return $naziv;
		}
		return $naziv;
	}
	function proveraOpisa($vrednost) {
		$opis = array("value" => $vrednost, "errorMessage" => "", "ok" => true);
		if(empty($vrednost)) {
			$opis["errorMessage"] = "Morate uneti opis";
			$opis["ok"] = false;
			return $opis;
		}
		return $opis;
	}
	function validno($data) {
		foreach ($data as $key => $polje) {
			if(!is_array($polje)) continue;
			if(!$polje["ok"]) return false;
		}
		return true;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$data["naziv"] = proveraNaziva(test_input($_POST["naziv"]));
		$data["opis"] = proveraOpisa(test_input($_POST["opis"]));
		if(validno($data)) {
			$sql = "INSERT INTO teme(naziv, opis, autor_id) 
					VALUES ('". $data["naziv"]["value"] . "', '". $data["opis"]["value"] . "', '". $_SESSION["korisnik"]["id"] . "')";
			if($conn->query($sql) == TRUE) {
				header("location: /");
			}
			else {
				$data["errorMessage"] = "Došlo je do greške probajte ponovo kasnije";
				$data["ok"] = false;
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/global.css">
	<link rel="stylesheet" href="./css/registracija-prijava.css">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<style>
		textarea {
			display: block;
		}
	</style>
	<title>Teme</title>
</head>
<body>
<?php if(!($data["ok"])) echo "<p class='error'>" . $data["errorMessage"] . "</p>"; ?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<label for="naziv">Naziv:</label>
		<input type="text" name="naziv" id="naziv" value="<?php echo $data["naziv"]["value"] ?>"> 
		<?php if(!($data["naziv"]["ok"])) echo "<p class='error'>" . $data["naziv"]["errorMessage"] . "</p>"; ?>
		
		<label for="opis">Opis:</label>
		<textarea name="opis" id="opis" value="<?php echo $data["opis"]["value"] ?>"></textarea> 
		<?php if(!($data["opis"]["ok"])) echo "<p class='error'>" . $data["opis"]["errorMessage"] . "</p>"; ?>
		
		<button type="submit">Kreiraj temu</button>
	</form>
</body>
</html>