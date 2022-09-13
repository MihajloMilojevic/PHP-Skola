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

        function uspeh($ime, $email, $sediste, $film, $termin) {
            return ($ime["ok"] && $email["ok"] && $sediste["ok"] && $film["ok"] && $termin["ok"]);
        }

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

        function proveraFilma($vrednost) {
            $film = array("value" => $vrednost, "error" => "", "ok" => true);
            if(empty($vrednost)) {
                $film["error"] = "Morate uneti film";
                $film["ok"] = false;
                return $film;
            }
            return $film;
        }

        function proveraTermina($vrednost) {
            $termin = array("value" => $vrednost, "error" => "", "ok" => true);
            if(empty($vrednost)) {
                $termin["error"] = "Morate uneti termin";
                $termin["ok"] = false;
                return $termin;
            }
            return $termin;
        }

        function proveraSedista($vrednost) {
            $sediste = array("value" => $vrednost, "error" => "", "ok" => true);
            if(empty($vrednost)) {
                $sediste["error"] = "Morate uneti broj sedišta";
                $sediste["ok"] = false;
                return $sediste;
            }
            if(!preg_match('/^[\d,]*$/i', $vrednost, $matches)) {
                $sediste["error"] = "Morate uneti samo brojeve sedišta odvojenih zarezom";
                $sediste["ok"] = false;
                return $sediste;
            }
            str_replace(" ", "", $vrednost);
            $brojevi = explode(",", $vrednost);
            array_map(function($str) {return intval($str);}, $brojevi);
            
            foreach ($brojevi as $key => $value) {
                if($value < 1 || $value > 79) {
                    $sediste["error"] = "Morate uneti broj sedišta između 1 i 78";
                    $sediste["ok"] = false;
                    return $sediste;
                }
            }
            return $sediste;
        }

        $ime = array("value" => "", "error" => "", "ok" => true);
        $email = array("value" => "", "error" => "", "ok" => true);
        $sediste = array("value" => "", "error" => "", "ok" => true);
        $film = array("value" => "", "error" => "", "ok" => true);
        $termin = array("value" => "", "error" => "", "ok" => true);
        $id = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ime = proveraImena(security($_POST["ime"]));
            $email = proveraEmaila(security($_POST["email"]));
            $sediste = proveraSedista($_POST["sediste"]);
            $film = proveraFilma($_POST["film"]);
            $termin = proveraTermina($_POST["termin"]);
            if(uspeh($ime, $email, $sediste, $film, $termin)) {
                $id = uniqid();
                $myfile = fopen("./karte/" . $id . ".txt", "w");
                fwrite(
                    $myfile, 
                    "Izvrsena je rezervacija na ime " . $ime["value"]. ",\n" .
                    "za film " . $film["value"] . "\n" .
                    "u terminu " . $termin["value"] . ".\n" .
                    "Broj sedista je: " . $sediste["value"] . "."
                );
                fclose($myfile);
            }
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
        <label for="film">Film:</label> <br>
        <select name="film" id="film">
            <option value=""></option>
            <option value="Film1">Film1</option>
            <option value="Film2">Film2</option>
            <option value="Film3">Film3</option>
        </select> 
        <?php 
            if(!$film["ok"]) {
				echo "<span class='error'>" . $film["error"] . "</span>";
			}
        ?>
        <br>
        <br>
        <label for="termin">Termin:</label> <br>
        <select name="termin" id="termin">
            <option value=""></option>
            <option value="16h">16h</option>
            <option value="18h">18h</option>
            <option value="20h">20h</option>
        </select> 
        <?php 
            if(!$termin["ok"]) {
				echo "<span class='error'>" . $termin["error"] . "</span>";
			}
        ?>
        <br>
        <label for="sediste">Sedište:</label> <br>
        <input type="text" name="sediste" id="sediste" placeholder="Sedište"> 
        <?php 
            if(!$sediste["ok"]) {
                echo "<span class='error'>" . $sediste["error"] . "</span>";
            }
        ?>
        <br>
        <button type="submit">Rezerviši</button>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && uspeh($ime, $email, $sediste, $film, $termin)) {
            echo "<div class='php'>";
            echo "<p>Poštovani, " . $ime["value"] . " uspešno ste rezervisali ulaznicu za bioskop. <br> Preuzmite kartu klikom <a href='download.php?url=" . $id . ".txt'>ovde</a>.</p>";
            echo "</div>";
        }
    ?>
</body>
</html>