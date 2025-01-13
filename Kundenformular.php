<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center><h1>Wo möchten sie hin?</h1></center><br><br><br>
    <h3>Bitte Wählen sie Ihre <b>Anfangsstaion</b> sowie ihre <b>Endstation</b> aus.</h3><br>

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
        <input type="submit" name="submit" size="5">
    </from>
</body>
</html>