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
		"errorMessage" => "",
		"ok" => true
	);
	
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
	function validno($data) {
		foreach ($data as $key => $polje) {
			if(!is_array($polje)) continue;
			if(!$polje["ok"]) return false;
		}
		return true;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$data["email"] = proveraEmaila(test_input($_POST["email"]));
		$data["lozinka"] = proveraLozinke(test_input($_POST["lozinka"]));
		if(validno($data)) {
			$sql = "SELECT * FROM korisnici WHERE email = '" . $data["email"]["value"] . "'";
			$res = $conn->query($sql);
			if($res->num_rows == 0) {
				$data["errorMessage"] = "Korisnik sa unetom email adresom ne postoji";
				$data["ok"] = false;
			}
			else {
				$korisnik = $res->fetch_assoc();
				if($korisnik["lozinka"] == $data["lozinka"]["value"]) {
					$_SESSION["korisnik"] = array(
						"id" => $korisnik["id"],
						"ime" => $korisnik["ime"],
						"prezime" => $korisnik["prezime"],
						"email" => $korisnik["email"]
					);
					header("location: /");
				}
				else {
					$data["errorMessage"] = "Pogrešna lozinka";
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
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<title>Prijava </title>
</head>
<body>
<?php if(!($data["ok"])) echo "<p class='error'>" . $data["errorMessage"] . "</p>"; ?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		
		<label for="email">Email:</label>
		<input type="text" name="email" id="email" value="<?php echo $data["email"]["value"] ?>"> 
		<?php if(!($data["email"]["ok"])) echo "<p class='error'>" . $data["email"]["errorMessage"] . "</p>"; ?>
		
		<label for="lozinka">Lozinka:</label>
		<input type="password" name="lozinka" id="lozinka"> 
		<?php if(!($data["lozinka"]["ok"])) echo "<p class='error'>" . $data["lozinka"]["errorMessage"] . "</p>"; ?>
		
		<button type="submit">Prijavi se</button>

	</form>
</body>
</html>