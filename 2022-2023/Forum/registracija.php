<?php
	session_start();
	require "./DATABASE/connection.php";
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }

	$data = array(
		"ime" => array(
			"value" => "",
			"errorMessage" => "",
			"ok" => true
		),
		"prezime" => array(
			"value" => "",
			"errorMessage" => "",
			"ok" => true
		),
		"email" => array(
			"value" => "",
			"errorMessage" => "",
			"ok" => true
		),
		"lozinka" => array(
			"value" => "",
			"errorMessage" => "",
			"ok" => true
		),
		"potvrda" => array(
			"value" => "",
			"errorMessage" => "",
			"ok" => true
		),
		"errorMessage" => "",
		"ok" => true
	);
	
	function proveraImena($vrednost) {
		$ime = array("value" => $vrednost, "errorMessage" => "", "ok" => true);
		if(empty($vrednost)) {
			$ime["errorMessage"] = "Morate uneti ime";
			$ime["ok"] = false;
			return $ime;
		}
		if(!preg_match("/^[a-zA-Z\s]*$/", $vrednost)) {
			$ime["errorMessage"] = "Ime mora sadržati samo slova";
			$ime["ok"] = false;
			return $ime;
		}
		return $ime;
	}
	function proveraPrezimena($vrednost) {
		$prezime = array("value" => $vrednost, "errorMessage" => "", "ok" => true);
		if(empty($vrednost)) {
			$prezime["errorMessage"] = "Morate uneti prezime";
			$prezime["ok"] = false;
			return $prezime;
		}
		if(!preg_match("/^[a-zA-Z\s]*$/", $vrednost)) {
			$prezime["errorMessage"] = "Prezime mora sadržati samo slova";
			$prezime["ok"] = false;
			return $prezime;
		}
		return $prezime;
	}
	function proveraEmaila($vrednost) {
		$email = array("value" => $vrednost, "errorMessage" => "", "ok" => true);
		if(empty($vrednost)) {
			$email["errorMessage"] = "Morate uneti email";
			$email["ok"] = false;
			return $email;
		}
		if(!filter_var($vrednost, FILTER_VALIDATE_EMAIL)) {
			$email["errorMessage"] = "Morate uneti ispravan format mejla";
			$email["ok"] = false;
			return $email;
		}
		return $email;
	}
	function proveraLozinke($vrednost) {
		$lozinka = array("value" => $vrednost, "errorMessage" => "", "ok" => true);
		if(empty($vrednost)) {
			$lozinka["errorMessage"] = "Morate uneti lozinku";
			$lozinka["ok"] = false;
			return $lozinka;
		}
		return $lozinka;
	}
	function proveraPotvrde($vrednost, $password) {
		$lozinka = array("value" => $vrednost, "errorMessage" => "", "ok" => true);
		if(empty($vrednost)) {
			$lozinka["errorMessage"] = "Morate potvrditi lozinku";
			$lozinka["ok"] = false;
			return $lozinka;
		}
		if($password != $lozinka["value"]) {
			$lozinka["errorMessage"] = "Lozinke se ne podudaraju";
			$lozinka["ok"] = false;
			return $lozinka;
		}
		return $lozinka;
	}
	function validno($data) {
		foreach ($data as $key => $polje) {
			if(!is_array($polje)) continue;
			if(!$polje["ok"]) return false;
		}
		return true;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$data["ime"] = proveraImena(test_input($_POST["ime"]));
		$data["prezime"] = proveraPrezimena(test_input($_POST["prezime"]));
		$data["email"] = proveraEmaila(test_input($_POST["email"]));
		$data["lozinka"] = proveraLozinke(test_input($_POST["lozinka"]));
		$data["potvrda"] = proveraPotvrde(test_input($_POST["potvrda"]), $data["lozinka"]["value"]);
		if(validno($data)) {
			$sql = "SELECT COUNT(*) as broj FROM korisnici WHERE email = '" . $data["email"]["value"] . "'";
			$res = $conn->query($sql);
			$res = ($res->fetch_assoc());
			if($res["broj"] > 0) {
				$data["errorMessage"] = "Korisnik sa unetom email adresom već postoji";
				$data["ok"] = false;
			}
			else {
				$sql = "INSERT INTO korisnici(ime, prezime, email, lozinka) 
						VALUES ('". $data["ime"]["value"] . "', '". $data["prezime"]["value"] . "', '". $data["email"]["value"] . "', '". $data["lozinka"]["value"] . "')";
				if($conn->query($sql) == TRUE) {
					$_SESSION["korisnik"] = array(
						"id" => $conn->insert_id,
						"ime" => $data["ime"]["value"],
						"prezime" => $data["prezime"]["value"],
						"email" => $data["email"]["value"]
					);
					header("location: /");
				}
				else {
					$data["errorMessage"] = "Došlo je do greške probajte ponovo kasnije";
					$data["ok"] = false;
				}
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
	<title>Registracija</title>
</head>
<body>
<?php if(!($data["ok"])) echo "<p class='error'>" . $data["errorMessage"] . "</p>"; ?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<label for="ime">Ime:</label>
		<input type="text" name="ime" id="ime" value="<?php echo $data["ime"]["value"] ?>"> 
		<?php if(!($data["ime"]["ok"])) echo "<p class='error'>" . $data["ime"]["errorMessage"] . "</p>"; ?>
		
		<label for="prezime">Prezime:</label>
		<input type="text" name="prezime" id="prezime" value="<?php echo $data["prezime"]["value"] ?>"> 
		<?php if(!($data["prezime"]["ok"])) echo "<p class='error'>" . $data["prezime"]["errorMessage"] . "</p>"; ?>
		
		<label for="email">Email:</label>
		<input type="text" name="email" id="email" value="<?php echo $data["email"]["value"] ?>"> 
		<?php if(!($data["email"]["ok"])) echo "<p class='error'>" . $data["email"]["errorMessage"] . "</p>"; ?>
		
		<label for="lozinka">Lozinka:</label>
		<input type="password" name="lozinka" id="lozinka"> 
		<?php if(!($data["lozinka"]["ok"])) echo "<p class='error'>" . $data["lozinka"]["errorMessage"] . "</p>"; ?>
		
		
		<label for="potvrda">Potvrda lozinke:</label>
		<input type="password" name="potvrda" id="potvrda"> 
		<?php if(!($data["potvrda"]["ok"])) echo "<p class='error'>" . $data["potvrda"]["errorMessage"] . "</p>"; ?>
		
		<button type="submit">Registruj se</button>

	</form>
</body>
</html>