<!DOCTYPE html>
<html lang="sr-RS">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
    <title>Rezervacija bioskopske ulaznice</title>
</head>
<body>
    <?php

use function PHPSTORM_META\type;

        function security($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function proveraImena($vrednost) {
            $ime = array("value" => $vrednost, "error" => "", "ok" => true);
            if(empty($vrednost)) {
                $ime["error"] = "Morate uneti ime";
                $ime["ok"] = false;
                return $ime;
            }
            if(!preg_match("/^[a-zA-Z\s]*$/", $vrednost)) {
                $ime["error"] = "Ime mora sadržati samo slova";
                $ime["ok"] = false;
                return $ime;
            }
            if(str_word_count($vrednost) == 1) {
                $ime["error"] = "Morate uneti i ime i prezime";
                $ime["ok"] = false;
                return $ime;
            }
            return $ime;
        }
        function proveraEmaila($vrednost) {
            $email = array("value" => $vrednost, "error" => "", "ok" => true);
            if(empty($vrednost)) {
                $email["error"] = "Morate uneti email";
                $email["ok"] = false;
                return $email;
            }
            if(!filter_var($vrednost, FILTER_VALIDATE_EMAIL)) {
                $email["error"] = "Morate uneti ispravan format mejla";
                $email["ok"] = false;
                return $email;
            }
            return $email;
        }

        function proveraSedista($vrednost) {
            $sediste = array("value" => $vrednost, "error" => "", "ok" => true);
            if(empty($vrednost)) {
                $sediste["error"] = "Morate uneti broj sedišta";
                $sediste["ok"] = false;
                return $sediste;
            }
            if($vrednost < 1 || $vrednost > 79) {
                $sediste["error"] = "Morate uneti broj sedišta između 1 i 78";
                $sediste["ok"] = false;
                return $sediste;
            }
            return $sediste;
        }

        $ime = array("value" => "", "error" => "", "ok" => true);
        $email = array("value" => "", "error" => "", "ok" => true);
        $sediste = array("value" => "", "error" => "", "ok" => true);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ime = proveraImena(security($_POST["ime"]));
            $email = proveraEmaila(security($_POST["email"]));
            $sediste = proveraSedista(intval($_POST["sediste"]));
        }
    ?>
    <h1>Rezervacija bioskopske ulaznice</h1>
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <label for="ime">Ime:</label> <br>
        <input type="text" name="ime" id="ime" placeholder="Ime"> 
        <?php 
            if(!$ime["ok"]) {
				echo "<span class='error'>" . $ime["error"] . "</span>";
			}
        ?>
        <br>
        <label for="email">Email:</label> <br>
        <input type="text" name="email" id="email" placeholder="email"> 
        <?php 
            if(!$email["ok"]) {
				echo "<span class='error'>" . $email["error"] . "</span>";
			}
        ?>
        <br>
        <label for="sediste">Sediste:</label> <br>
        <input type="number" name="sediste" id="sediste" placeholder="Sedište"> 
        <?php 
            if(!$sediste["ok"]) {
                echo "<span class='error'>" . $sediste["error"] . "</span>";
            }
        ?>
        <br>
        <button type="submit">Rezerviši</button>
    </form>
    <?php
        function uspeh($ime, $email, $sediste) {
            return ($ime["ok"] && $email["ok"] && $sediste["ok"]);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && uspeh($ime, $email, $sediste)) {
            echo "<div class='php'>";
            echo "<p>Poštovani, " . $ime["value"] . " uspešno ste rezervisali ulaznicu za bioskop. Ulaznica će stići na Vaš email: " . $email["value"] . "</p>";
            echo "</div>";
        }
    ?>
</body>
</html>