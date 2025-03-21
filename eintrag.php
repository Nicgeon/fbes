<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Eintrag abgeschlossen</title>
</head>
<body>
    <?php
    $von = $_GET['von'];
    $bis = $_GET['bis'];

    $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');

    $sql_1 = "SELECT distinct(v.ID_linie)
                FROM stationen AS s
                JOIN verbindungen AS v
                ON v.ID_Station = s.ID_Station
                WHERE s.NAME = '$von'
                ORDER BY v.ID_linie
                Limit 1";
    $sql_2 = "SELECT distinct(v.ID_linie)
                FROM stationen AS s
                JOIN verbindungen AS v
                ON v.ID_Station = s.ID_Station
                WHERE s.NAME = '$bis'
                ORDER BY v.ID_linie
                Limit 1";
    
    $l_von = null;
    foreach($PDO->query($sql_1) as $row){
        $l_von = $row['ID_linie'];
    }
    $l_bis = null;
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

    if($l_bis == $l_von && !is_null($l_bis) && !is_null($l_von)) {
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
        echo "<h1>Ihre Eingabe wurde übermittelt</h1><br><br><nobr>Sie fahren von <u>".$von."</u> bis <u>".$bis."</u></nobr> mit der Linie <b><u>".$l_von."</u></b><br><br>";
    }
    else {
        echo "<h1>Keine Linie gefunden.</h1><br><br>Aktuell gibt es keine Verbindung von ".$von." bis ".$bis.".<br>wir bitten um Entschuldigung<br><br>";
        $l_von = null;
    }

    if(!is_null($l_von)) {
        echo "<center><h2>PDF Ihrer Linie</h2></center>";
        ?>

    <center>
        <object 
        type="application/PDF" 
        data="./res/pdf/<?php echo $l_von?>.pdf"
        width="95%"
        height="450px"
        ></object>
        <i><br>Die PDF stammt von dem jeweiligen Busunternehmen, ich übernehme keine garantie für richtigkeit.</i>
    </center>

    <div style="padding-bottom: 20%;">

    </div>
    <?php
    }
    ?>

    <footer class='footer'>
    <form action='./zurücknehmen.php' method='post' class="login-form">
    
    <input type="hidden" name="von" value="<?php echo htmlspecialchars($von); ?>">
    <input type="hidden" name="l_von" value="<?php echo htmlspecialchars($l_von); ?>">
    <button type="submit" name="zurück" class="login-button" formaction="./Kundenformular.php">Fertig</button>
    <?php
    # Zurücksetzen Button
    if ($l_bis == $l_von) {
        echo "<input type='submit' name='zurücksetzen' class='login-button' value='Zurücknehmen'>";
    }
    ?>
    </form>
    </footer>
</body>
</html>