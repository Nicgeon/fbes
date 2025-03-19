<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kundenformular</title>
</head>
<body>
    <div class="content">
        <center><h1>Wo möchten Sie hin?</h1></center><br>
        <h3>Bitte wählen sie Ihre <b>Anfangsstation</b> sowie Ihre <b>Endstation</b> aus.</h3>

        <form action="./eintrag.php" method="get">
            <input type="text" list="Stationen" name="von" placeholder="Startstation">
            bis
            <input type="text" list="Stationen" name="bis" placeholder="Endstation">
            <br><br><br>
            <input type="submit" name="Kundendaten" value="Weiter">
        </from>
    
        <datalist id="Stationen">
            <?php
                $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');
                $sql = "SELECT stationen.NAME
                        FROM stationen, verbindungen
                        WHERE stationen.ID_Station = verbindungen.ID_Station
                        GROUP BY stationen.ID_Station
                        ORDER BY stationen.NAME";
                
                foreach($PDO->query($sql) as $row){
                    echo "<option value='".$row['NAME']."'>";
                }
            ?>
        </datalist>

    </div>
    <div>
    <footer class="footer">
        <form action="./Login.php" method="post" class="login-form">
            <Button type="submit" name="Login" class="login-button" formaction="./Login.php">Busfahrer Login</Button>
        </form>
    </footer>
    </div>
</body>
</html>