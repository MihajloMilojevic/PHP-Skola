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
	<title>Zadatak 6</title>
</head>
<body>
	<?php 
		if(!isset($_SESSION["proizvodi"]))
			$_SESSION["proizvodi"] = array();
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST["proizvodi"]))
				$_SESSION["proizvodi"] = array_unique(array_merge($_POST["proizvodi"], $_SESSION["proizvodi"]), SORT_REGULAR);
		}
	?>
	<h1 class="title">Zadatak 6</h1>
	<p>Sesije 2</p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
		
		<select name="proizvodi[]" id="proizvodi" multiple size="10">
			<option value="Patike">Patike</option>
			<option value="Trenerka">Trenerka</option>
			<option value="Duks">Duks</option>
			<option value="Majca">Majca</option>
			<option value="Kosulja">Kosulja</option>
			<option value="Farmerke">Farmerke</option>
			<option value="Jakna">Jakna</option>
			<option value="Prsluk">Prsluk</option>
			<option value="Pantalone">Pantalone</option>
			<option value="Carape">Carape</option>
		</select> <br>
		<button type="submit">Potvrdi</button>
	</form>
	<a href="./lista.php">Vaš izbor</a>
</html>