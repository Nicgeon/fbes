<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'root', '');
        $von = $_POST['von'];
        $sql = "UPDATE stationen SET wartet = wartet - 1 WHERE NAME = '$von'";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
        
        echo "<h1>Zurückgesetzt für Station: " . htmlspecialchars($von)."</h1>";
    ?>
</body>
</html>