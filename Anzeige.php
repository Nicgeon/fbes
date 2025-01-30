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
    <?php 
        session_start();
        if(!isset($_SESSION['Login']) || !$_SESSION['Login'] == true) {
            header("Location: Login.php");
            die;
        }
        if (!isset($_SESSION['mark'])) {
            $_SESSION['mark'] = 0;
        }
        
        if (isset($_GET['Weiter'])) {
            $_SESSION['mark']++;
        }

        if (isset($_GET['zurück'])) {
            $_SESSION['mark']--;
        }
        
        $mark = $_SESSION['mark'];
        $Linie = $_SESSION['Linie'];

        $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');

        $sql = "SELECT stationen.Name, verbindungen.Wartet, verbindungen.Uhrzeit
                FROM linie 
                INNER JOIN verbindungen 
                ON linie.ID_Linie = verbindungen.ID_linie
                INNER JOIN stationen
                ON stationen.ID_Station = verbindungen.ID_Station
                ORDER BY verbindungen.Uhrzeit DESC";
        $PDO->prepare($sql);
        $i = 0;

        foreach($PDO->query($sql) as $row) {
            $letzter = array_key_last($row);
            $Zeit = date("H:i:s", strtotime($row['Uhrzeit']));
            if($i == $mark) {
                echo "<tr id='$i' class='highlight'>";
            }
            else {
                echo "<tr id='$i'>";
            }
            if ($i >= $mark) {
                echo "<td><b>".$row['Name']."</b><br>".$Zeit."</td><td id='Wartet'>".$row['Wartet']."</td></tr>";
                if ($i == $mark) {
                    echo "</table>";
                    echo "<div><form><input type='submit' value='Nächste Station' name='Weiter' id='weiter'></div>";
                    echo "<div><input type='submit' value='Letzte Station' name='zurück' id='zurück'></form></div>";
                    echo "<table id='myTable'>";
                }
            }
            $i++;
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