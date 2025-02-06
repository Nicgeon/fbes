<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Eintrag Abgeschlossen</title>
</head>
<body>
    <?php
    $von = $_GET['von'];
    $bis = $_GET['bis'];

    $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');

    $sql_1 = "SELECT v.ID_linie
                FROM stationen AS s
                JOIN verbindungen AS v
                ON v.ID_Station = s.ID_Station
                WHERE s.NAME = '$von'";
    $sql_2 = "SELECT v.ID_linie
                FROM stationen AS s
                JOIN verbindungen AS v
                ON v.ID_Station = s.ID_Station
                WHERE s.NAME = '$bis'";
    
    $l_von = 0;
    foreach($PDO->query($sql_1) as $row){
        $l_von = $row['ID_linie'];
    }
    $l_bis = 0;
    foreach($PDO->query($sql_2) as $row){
        $l_bis = $row['ID_linie'];
    }

    $sql = "UPDATE verbindungen AS v
            SET Wartet = Wartet + 1
            WHERE v.ID_station = (SELECT s.ID_Station
            FROM stationen AS s
            JOIN verbindungen AS v
            ON v.ID_Station = s.ID_Station
            WHERE s.NAME = '$von')";

    if($l_bis == $l_von) {
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
        echo "<nobr><h1>Ihre Eingabe wurde übermittelt</h1><br><br>Sie fahren von <u>".$von."</u> bis <u>".$bis."</u> mit der linie <b><u>".$l_von."</u></nobr></b><br><br>";
    }
    else {
        echo "<h1>Keine Linie Gefunden</h1><br><br>Aktuell gibt es keine Verbindung von ".$von." bis ".$bis."<br>wir bitten um entschuldigung<br><br>";
    }


    # Zurücksetzen Button
    echo "<form action='./zurücknehmen.php' method='post' class='button-container'>
        <input type='hidden' name='von' value='" . htmlspecialchars($von) . "'>
        <div class='button-group'>
            <button type='submit' name='zurück' formaction='./Kundenformular.php'>Fertig</button>
            <input type='submit' name='zurücksetzen' value='Zurücknehmen'>
        </div>
    </form>";
    ?>

</body>
</html>