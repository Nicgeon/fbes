<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'root', '');
        $von = $_POST['von'];
        $sql = "UPDATE verbindungen AS v
        SET Wartet = Wartet - 1
        WHERE v.ID_station = (SELECT s.ID_Station
        FROM stationen AS s
        JOIN verbindungen AS v
        ON v.ID_Station = s.ID_Station
        WHERE s.NAME = '$von')";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
        
        echo "<center><h1>Zurückgesetzt für Station: " . htmlspecialchars($von)."</h1></center>";
    ?>
</body>
</html>