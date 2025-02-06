<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>Fahrtanzeige</title>
</head>
<body>

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
    ?>

    <div>
      <center><h1>Fahrtanzeige</h1></center>
    </div>

    <div>
        <table id="myTable">
            <tr><th>Station</th><th>Personen</th></tr>
        <?php 
            $mark = $_SESSION['mark'];
            $Linie = $_SESSION['Linie'];

            $f_name = $_SESSION['Name'];

            $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');

            $sql = "SELECT stationen.Name, verbindungen.Wartet, verbindungen.Uhrzeit
                    FROM linie 
                    INNER JOIN verbindungen 
                    ON linie.ID_Linie = verbindungen.ID_linie
                    INNER JOIN stationen
                    ON stationen.ID_Station = verbindungen.ID_Station
                    ORDER BY verbindungen.Uhrzeit ASC";
            $PDO->prepare($sql);
            $i = 0;
            $j = 0;

            foreach($PDO->query($sql) as $row) {
                if($i == $mark-1 && $i > 1) {
                    $name = $row['Name'];
                    $sql_1 = "UPDATE verbindungen AS v SET v.Wartet = 0 
                            WHERE v.ID_Station = (SELECT s.ID_Station FROM stationen AS s WHERE s.NAME = '$name')";
                    $stmt = $PDO->prepare($sql_1);
                    $stmt->execute();
                }
                $Zeit = date("H:i:s", strtotime($row['Uhrzeit']));
                if($i == $mark) {
                    echo "<tr id='$i' class='highlight'>";
                }
                else {
                    echo "<tr id='$i'>";
                }
                if ($i >= $mark) {
                    echo "<td><b>".$row['Name']."</b><br>".$Zeit."</td><td id='Wartet'>".$row['Wartet']."</td></tr>";
                    $j++;
                }
                $i++;
            }

            if($j < 1) {
                echo "</table>";
                echo "<center><h1>Fahrt Abgeschlossen</h1>";
                echo "<form action='./Login.php' method='post'>
                        <Button type='submit' name='Login' formaction='./Login.php' class='navi'>Zurück zum Login</Button>
                    </form><center>";
                die();
            }
        ?>
        </table>
    </div>
    <div style="height: 10vh;"></div>
    <footer class="footer">
        <form>
        <center>
            <input type='submit' value='Letzte Station' name='zurück' class='navi'>

            <input type='submit' value='Nächste Station' name='Weiter' class='navi'>
        </center>
        </form>
        <form action="./Login.php" method="post" class="login-form">
            <Button type="submit" name="Login" formaction="./Login.php">Busfahrer Login</Button>
        </form>
        <?php
            if($mark == 0) {
                echo "<center><h2>Willkommen $f_name</h2></center>";
            }
        ?>
    </footer>
</body>
</html>