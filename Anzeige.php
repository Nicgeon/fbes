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

    <table id="myTable">
    <?php 
        session_start();
        if(!isset($_SESSION['Login']) || !$_SESSION['Login'] == true) {
            header("Location: Login.php");
            die;
        }
        $Linie = $_SESSION['Linie'];

        $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');

        $sql = "SELECT stationen.Name, verbindungen.Wartet, verbindungen.Uhrzeit
                FROM linie 
                INNER JOIN verbindungen 
                ON linie.ID_Linie = verbindungen.ID_linie
                INNER JOIN stationen
                ON stationen.ID_Station = verbindungen.ID_Station
                WHERE linie.ID_Linie = $Linie
                ORDER BY verbindungen.Uhrzeit ASC";

        $stmt = $PDO->prepare($sql);

        foreach($PDO->query($sql) as $row) {
            echo "<tr><td><b>".$row['Name']."</b><br>".$row['Uhrzeit']."</td><td>".$row['Wartet']."</td></tr>";
        }
    ?>
    </table>

    <script>
            const table = document.getElementById('myTable');
            let currentHighlight = 0;

            window.addEventListener('wheel', (event) => {
            const rows = table.getElementsByTagName('tr');
            
            // Entferne die Hervorhebung von der aktuellen Zeile
            if (rows[currentHighlight]) {
                rows[currentHighlight].classList.remove('highlight');
            }
            
            // Ändere den Index basierend auf der Scrollrichtung
            if (event.deltaY > 0) {
                currentHighlight = (currentHighlight + 1) % rows.length;
            } else {
                currentHighlight = (currentHighlight - 1 + rows.length) % rows.length;
            }
            
            // Füge die Hervorhebung zur neuen Zeile hinzu
            rows[currentHighlight].classList.add('highlight');
            
            // Verhindere das normale Scrollverhalten
            event.preventDefault();
            });
    </script>
</body>
</html>