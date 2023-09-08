<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    $nom = $lien = $type = $date = "";

    $nomErr = $lienErr = $typeErr = $dateErr = "";

    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //echo "POST";
        //Si on entre, on est dans l'envoie du formulaire

        if (empty($_POST['nom'])) {
            $nomErr = "Le nom est requis";
            $erreur = true;
        } else {
            $nom = test_input($_POST["nom"]);
        }

        if (empty($_POST['lien'])) {
            $lienErr = "Le lien est requis";
            $erreur = true;
        } else {
            $lien = test_input($_POST["lien"]);
        }
        if (empty($_POST['type'])) {
            $typeErr = "Le type de jeu est requis";
            $erreur = true;
        } else {
            $type = test_input($_POST["type"]);
        }
        if (empty($_POST['date'])) {
            $dateErr = "La date est requise";
            $erreur = true;
        } else {
            $date = test_input($_POST["date"]);
        }
        if ($erreur == false) {
    ?>


<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "bdtest";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}


$sql = "INSERT INTO jeuxvideo (id, nom, type, date, url)
            VALUES (NULL" . ",'" . $_POST['nom'] . "','" . $_POST['type'] . "','" . $_POST['date'] . "','" . $_POST['lien'] . "')";

if(mysqli_query($conn, $sql)){
    echo "Réussi";
}else{
    echo "Error: ". $sql . "<br>".mysqli_error($conn);
}
header("location:index.php?action=ajouter");
mysqli_close($conn);
?>


<?php
        }
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {


        ?>
        <form class="row" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Nom</label>
                <input type="name" class="form-control" id="exampleInputName1" name="nom">
                <span style="color:red"><?php echo $nomErr ?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputLink1" class="form-label">Lien vers une image du jeu </label>
                <input type="url" class="form-control" id="exampleInputLink1" name="lien">
                <span style="color:red"><?php echo $lienErr ?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Type de jeu</label>
                <input type="name" class="form-control" id="exampleInputPassword1" name="type">
                <span style="color:red"><?php echo $typeErr ?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputDate1" class="form-label">Date de sortie</label>
                <input type="date" class="form-control" id="exampleInputDate1" name="date">
                <span style="color:red"><?php echo $dateErr ?></span>
            </div>

            <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-primary" >Submit</button>
                <a class="btn btn-primary" href="index.php">Revenir</a>
            </div>
        </form>

    <?php
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>