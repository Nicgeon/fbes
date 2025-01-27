<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>Fahrtanzeige</title>
</head>
<body>
    <div>
    <center><h1>Fahrtanzeige</h1></center>
    </div>
    <div>
    <table id="myTable">
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
            location.hash = "#" + currentHighlight
            
            // Verhindere das normale Scrollverhalten
            event.preventDefault();
            });
    </script>
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
                ORDER BY verbindungen.Uhrzeit DESC";

        $stmt = $PDO->prepare($sql);
        $i = 0;
        foreach($PDO->query($sql) as $row) {
            $Zeit = date("H:i:s", strtotime($row['Uhrzeit']));
            echo "<tr id='$i'><td class=><b>".$row['Name']."</b><br>".$Zeit."</td><td id='Wartet'>".$row['Wartet']."</td></tr>";
            $i++;
        }
        $currentHighlight = $_GET["uid"]; //puts the uid varialbe into $somevar
        if($i == $currentHighlight) {
            echo "<form><input type='submit' value='Weiter' name='weiter'/></form>";
        }
    ?>
    </div>
    </table>
        <div style="height: 200vh;"></div>


    <footer class="footer">
        <form action="./Login.php" method="post" class="login-form">
            <Button type="submit" name="Login" class="login-button" formaction="./Login.php">Busfahrer Login</Button>
        </form>
    </footer>
</body>
</html>