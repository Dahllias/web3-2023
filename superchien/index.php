<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
<!-- echo "id: " . $row["id"] . " - Nom: " . $row["nom"] . " - Type " . $row["type"] . " - Date de sortie " . $row["date"] . " - url " . $row["url"] . "<br>";-->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "bdtest";

    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }


    $sql = "SELECT id, nom, type, date, url FROM jeuxvideo";
    $conn->query('SET NAMES utf8');
    $result = $conn->query($sql);

    ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Type</th>
                <th scope="col">Date</th>
                <th scope="col">Image</th>
                <th scope="col">Paramètres</th>
            </tr>
        </thead>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               ?>
                <tbody>
                <tr>
                    <th scope="row"><?php echo $row["id"]?></th>
                    <td><?php echo $row["nom"]?></td>
                    <td><?php echo $row["type"]?></td>
                    <td><?php echo $row["date"]?></td>
                    <td><img src="<?php echo $row["url"]?>" alt="" class="test"></td>
                    <td class="buttonvert">
                        <a href="supprimer.php?id=<?php echo $row["id"] ?>" class="btn btn-danger maxh" type="button">Effacer</a>
                        <br/>
                        <a href="modifier.php?id=<?php echo $row["id"] ?>" class="btn btn-warning maxh" type="button">Modifier</a>
                    </td>
                </tr>
            </tbody>
            <?php
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </table>
    <a href="ajouter.php" class="btn btn-primary">Ajouter Données</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>

