<?php 
	$boje = array(
		"cornflowerblue", 
		"darksalmon",
		"palegoldenrod",
		"hotpink",
		"aquamarine",
		"mediumpurple",
		"slateblue"
	);
	function security($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$ime = array("value" => "", "error" => "", "ok" => true);
	$email = array("value" => "", "error" => "", "ok" => true);
	$doba = array("value" => "", "error" => "", "ok" => true);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(!empty($_POST["ime"])) {
			$ime["value"] = security($_POST["ime"]);
		}
		else {
			$ime["error"] = "Ime je obavezno";
			$ime["ok"] = false;
		}
		$email["value"] = security($_POST["email"]);
		if (!preg_match("/^[a-zA-Z]*$/",$ime["value"])) {
			$ime["error"] = "Ime mora da sadrži samo mala i velika slova";
			$ime["ok"] = false;
		}
		if (!filter_var(($email["value"]), FILTER_VALIDATE_EMAIL)) {
			$email["error"] = "Neispravan email";
			$email["ok"] = false;
		}
		if(empty($_POST["doba"])) {
			$doba["error"] = "Morate odabrati makar jedno doba";
			$doba["ok"] = false;
		}
		else
			$doba["value"] = $_POST["doba"];
	}
?>
<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	<title>Zadatak 7</title>
</head>
<body style="background: <?php echo $boje[date("w")]?>;">
	<h1 class="title">Zadatak 7</h1>
	<p>
		Validacija forme <br>
	</p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
		<label for="ime">Ime: </label>
		<input type="text" id="ime" name="ime"> 
		<?php 
			if(!$ime["ok"]) {
				echo "<span class='error'>" . $ime["error"] . "</span>";
			}
		?>
		<br>
		<label for="email">Email: </label>
		<input type="text" id="email" name="email">
		<?php 
			if(!$email["ok"]) {
				echo "<span class='error'>" . $email["error"] . "</span>";
			}
		?>
		<br>
		<label>Koja godišnja doba su Vam najdraža?</label>
		<?php 
			if(!$doba["ok"]) {
				echo "<span class='error'>" . $doba["error"] . "</span>";
			}
		?>
		<br>
		<input type="checkbox" name="doba[]" value="prolece" id="prolece"><label for="prolece">prolece</label> <br>
		<input type="checkbox" name="doba[]" value="leto" id="leto"><label for="leto">leto</label> <br>
		<input type="checkbox" name="doba[]" value="jesen" id="jesen"><label for="jesen">jesen</label> <br>
		<input type="checkbox" name="doba[]" value="zima" id="zima"><label for="zima">zima</label> <br>
		
		<button type="submit">PREDAJ</button>
	</form>
	<br>
	<div class="php">
		<?php 
			if($ime["ok"]) echo "<p>Ime:" . $ime["value"] . "</p>";
			if($email["ok"]) echo "<p>Email: " . $email["value"] . "</p>";
			if($doba["ok"]) echo "<p> Vaša omiljena godišnja doba su: " . join(", ", $doba["value"]) . "</p>";
		?>
	</div>
</body>
</html>