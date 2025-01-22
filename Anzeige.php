<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fahrtanzeige</title>
</head>
<body>
    <center><h1>Fahrtanzeige</h1></center>

    <table>
    <?php 
        $ID = include_once($Linie);

        $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');

        $sql = "SELECT stationen.Name, verbindungen.Wartet, verbindungen.Uhrzeit
                FROM linie 
                INNER JOIN verbindungen 
                ON linie.ID_Linie = verbindungen.ID_linie
                INNER JOIN stationen
                ON stationen.ID_Station = verbindungen.ID_Station
                WHERE linie.ID_Linie = $ID
                ORDER BY verbindungen.Uhrzeit ASC";

        $stmt = $PDO->prepare($sql);

        foreach($PDO->query($sql) as $row) {
            echo "<tr><td>".$row['Name']."<br>".$row['Uhrzeit']."</td><td>".$row['Wartet']."</td></tr>";
        }

    ?>
    </table>
</body>
</html>