<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Erfolg!</title>
</head>
<body>
    <?php

        $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');   
        $von = $_POST['von'];
        $l_von = $_POST['l_von'];
        $sql = "UPDATE verbindungen AS v
        SET Wartet = Wartet - 1
        WHERE v.ID_station = (SELECT s.ID_Station
        FROM stationen AS s
        JOIN verbindungen AS v
        ON v.ID_Station = s.ID_Station
        WHERE s.NAME = '$von')
        AND v.ID_Linie = '$l_von'";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
        
        echo "<center><h1>Zurückgesetzt für Station: <br>" .$von."</h1></center>";
    ?>

    <form action="./Kundenformular.php" method="get">
        <input type="submit" value="Zurück zur Startseite">
    </form>
</body>
</html>