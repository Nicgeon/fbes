<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <center><h1>Wo möchten sie hin?</h1></center><br>
        <h3>Bitte Wählen sie Ihre <b>Anfangsstaion</b> sowie ihre <b>Endstation</b> aus.</h3>

        <form action="./eintrag.php" method="get">
            <select id="Stationen" name="von" >
                <?php
                    $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'root', '');
                    $sql = "SELECT stationen.NAME
                            FROM stationen";
                    
                    foreach($PDO->query($sql) as $row){
                        echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>";
                    }
                ?>
            </select>
            bis
            <select id="Stationen" name="bis">
                <?php
                    $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'root', '');
                    $sql = "SELECT stationen.NAME
                            FROM stationen";
                    
                    foreach($PDO->query($sql) as $row){
                        echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>";
                    }
                ?>
            </select>
            <br><br><br>
            <input type="submit" name="Kundendaten" value="Weiter" size="5">
        </from>
    </div>
    <footer class="footer">
        <form action="./Login.php" method="post" class="login-form">
            <input type="submit" value="Busfahrer Login" name="Login" class="login-button">
        </form>
    </footer>
</body>
</html>