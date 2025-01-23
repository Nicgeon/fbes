<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Busfahrer Login</title>
</head>
<body>
    <h1>Fahrer Login</h1><br><br>
    <h3>Hallo, Melden sie sich an.</h3><br>
    <form>
        Bitte geben sie ihre Fahrer-ID ein.<br>
        <input type="text" name="ID">
        Linie
        <input type="text" name="Linie"><br>


    <?php 
        if(isset($_GET['submit'])) {
            session_start();
            $_SESSION = array();
            $ID = $_GET['ID'];
            $Linie = $_GET['Linie'];
            $dauer = 20;

            $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');
            $sql = "SELECT fahrer.Vorname
                    FROM fahrer
                    WHERE fahrer.ID_Fahrer = '$ID'";
            
            $ID_1 = null;
            foreach($PDO->query($sql) as $row){
                $ID_1 = $row['Vorname'];
            }

            $sql = "SELECT linie.Bezeichnung
                    FROM linie
                    WHERE linie.ID_Linie = '$Linie'";

            $Linie_1 = null;
            foreach($PDO->query($sql) as $row){
                $Linie_1 = $row['Bezeichnung'];
            }

            if (!is_null(value: $ID_1) && !is_null($Linie_1)) {
                $_SESSION['Login'] = true;
                $_SESSION['Linie'] = $Linie;
                header("Location: Anzeige.php");
                exit(); // Wichtig: Beenden Sie das Skript hier
            }
            elseif(is_null($ID_1) or is_null($Linie_1)){
                echo "<center>Logindaten sind falsch, bitte versuchen sie es erneut.</center><br><br>";
            }

        }
    ?>
            <input type="submit" name="submit" value="Einloggen"><br>
            </form>
</body>
</html>