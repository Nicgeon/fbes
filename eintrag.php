<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $von = $_GET['von'];
    $bis = $_GET['bis'];

    #Zurücksetzen Button
    echo "<h1>Ihre Eingabe wurde übermittelt</h1><br><br>Sie fahren von ".$von." bis ".$bis."<br><br>";
    echo "<form action='./zurücknehmen.php' method='post'>
            <input type='hidden' name='von' value='" . htmlspecialchars($von) . "'>
            <input type='submit' name='zurücksetzen' value='Zurücknehmen'>
            </form>";


    $PDO = new PDO('mysql:host=localhost; dbname=fbes;charset=utf8', 'root', '');

    #Halt der code der das ins programm hinzufügt
    $sql = "UPDATE stationen
            SET wartet = wartet + 1
            WHERE NAME = '$von'";

    $stmt = $PDO->prepare($sql);
    $stmt->execute();

    ?>
</body>
</html>