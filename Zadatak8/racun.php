<?php
	ini_set("allow_url_fopen", 1);
	$artikliJSON = file_get_contents("./artikli.json");
	$artikli = json_decode($artikliJSON);
	var_dump($_POST[$artikli[0]->naziv]);
	$naruceno = array();
	$ukupno = 0;
	$porez = 0.08;

	function security($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	echo json_encode($_POST);
	if ($_SERVER["REQUEST_METHOD"] !== "POST") 
		header('Location: index.php');
	
	for($i = 0; $i < count($artikli); $i++) {
		if(!empty($_POST[($artikli[$i]->naziv)]) || $_POST[$artikli[$i]->naziv] !== 0) {
			array_push($naruceno, array(
				"naziv" => $artikli[$i]->naziv,
				"kolicina" => intval($_POST[$artikli[$i]->naziv]),
				"cena" => $artikli[$i]->cena,
				"ukupno" => intval($_POST[$artikli[$i]->naziv]) * $artikli[$i]->cena
			));
			$ukupno += $naruceno[count($naruceno) - 1]["ukupno"];
		}
	}
	if(count($naruceno) == 0)
		header('Location: index.php');

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
	<h1 class="title"> Račun </h1>
	
</body>
</html>