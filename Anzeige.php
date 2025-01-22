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
        include Login.php;
        echo $ID;

        $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'fbes', '1234');

        $sql = "SELECT * FROM verbindung WHERE ID_Linie = $ID";

        $stmt = $PDO->prepare($sql);

    ?>
    </table>
</body>
</html>