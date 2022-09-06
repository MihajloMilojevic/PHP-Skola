<!DOCTYPE html>
<html lang="sr-RS">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteka</title>
</head>
<body>
    <?php 
        ini_set("allow_url_fopen", 1);
        $artikliJSON = file_get_contents("./artikli.json");
        $artikli = json_decode($artikliJSON);
    ?>
    <h1>Apoteka</h1>
    <form action="./racun.php" method="POST">
        <table>
            <thead>
                <tr>
                    <th>Artikal</th>
                    <th>Količina</th>
                    <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    for($i = 0; $i < count($artikli); $i++) {
                        echo "<tr>";
                        echo "<td>" . $artikli[$i]->naziv ."</td>";
                        echo "<td> <input type='number' min='0' name='". $artikli[$i]->naziv . "'> </td>";
                        echo "<td>" . $artikli[$i]->cena ."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <label>Kako ste saznali za našu apoteku</label>
        <select name="saznali">
            <option value="redovan">Redovan kupac</option>
            <option value="reklama">Reklama</option>
            <option value="oglas">Oglas</option>
        </select>
        <br>
        <button type="submit">Naruči</button>
    </form>
</body>
</html>