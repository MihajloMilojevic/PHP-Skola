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
	<title>Zadatak 7</title>
</head>
<body>
	<h1 class="title">Zadatak 7</h1>
	<p>
		Validacija forme <br>
	</p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
		<label for="ime">Ime: </label>
		<input type="text" id="ime" name="ime"> 
		<?php 
			if(isset($_SESSION["imeError"])) {
				echo "<span class='error'>" . $_SESSION["imeError"] . "</span>";
			}
		?>
		<br>
		<label for="email">Email: </label>
		<input type="text" id="email" name="email">
		<?php 
			if(isset($_SESSION["emailError"])) {
				echo "<span class='error'>" . $_SESSION["emailError"] . "</span>";
			}
		?>
		<br>
		<button type="submit">PREDAJ</button>
	</form>
	<br>
	<div class="php">
	<?php 
		function security($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$ime = $email = "";
		$imeOK = $emailOK = true;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(!empty($_POST["ime"])) {
				$ime = security($_POST["ime"]);
				$imeOK = false;
			}
			else {
				$_SESSION["imeError"] = "Ime je obavezno";
			}
			$email = security($_POST["email"]);
			if (!preg_match("/^[a-zA-Z]*$/",$ime)) {
				$_SESSION["imeError"] = "Ime mora da sadrži samo mala i velika slova";
				$imeOK = false;
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION["emailError"] = "Neispravan email";
				$emailOK = false;
			}
			if($imeOK) echo "<p>Ime: $ime</p>";
			if($emailOK) echo "<p>Email: $email</p>";
		}
	?>
	</div>
</body>
</html>