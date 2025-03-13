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
            <select id="Stationen" name="von" >
                <?php
                    $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');
                    $sql = "SELECT stationen.NAME
                            FROM stationen
                            ORDER BY stationen.NAME";
                    
                    foreach($PDO->query($sql) as $row){
                        echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>";
                    }
                ?>
            </select>
            bis
            <select id="Stationen" name="bis">
                <?php
                    $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');
                    $sql = "SELECT stationen.NAME
                            FROM stationen
                            ORDER BY stationen.NAME";
                    
                    foreach($PDO->query($sql) as $row){
                        echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>";
                    }
                ?>
            </select>
            <br><br><br>
            <input type="submit" name="Kundendaten" value="Weiter">
        </from>
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