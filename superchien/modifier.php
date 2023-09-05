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

$servername = "localhost";
$username = "root";
$password = "root";
$db = "bdtest";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql="SELECT * FROM jeuxvideo WHERE id=$id";
    $result = $conn->query($sql);

    if($result->num_rows>0){
        $row=$result->fetch_assoc();
    }
    $nom = $row["nom"];
    $type = $row["type"];
    $date = $row["date"];
    $lien = $row["url"];
}
elseif(isset($_POST["id"])){
    $id=$_POST["id"];
    
}
else{
    $erreur = true;
}


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
$sqlid = $_POST["id"];
$sqlnom = $_POST["nom"];
$sqltype = $_POST["type"];
$sqldate = $_POST["date"];
$sqllien = $_POST["lien"];


$sql = "UPDATE jeuxvideo
SET nom = '$sqlnom', type = '$sqltype', date = '$sqldate', url = '$sqllien'
WHERE id = '$sqlid'";


if(mysqli_query($conn, $sql)){
    echo "Réussi";
}else{
    echo "Error: ". $sql . "<br>".mysqli_error($conn);
}
header("location:index.php?action=modifier");

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
                <input type="name" class="form-control" id="exampleInputName1" name="nom" value="<?php echo "$nom" ?>">
                <span><?php echo $nomErr ?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputLink1" class="form-label">Lien vers une image du jeu </label>
                <input type="url" class="form-control" id="exampleInputLink1" name="lien" value="<?php echo "$lien" ?>">
                <span><?php echo $lienErr ?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Type de jeu</label>
                <input type="name" class="form-control" id="exampleInputPassword1" name="type" value="<?php echo "$type" ?>">
                <span><?php echo $typeErr ?></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputDate1" class="form-label">Date de sortie</label>
                <input type="date" class="form-control" id="exampleInputDate1" name="date" value="<?php echo "$date" ?>">
                <span><?php echo $dateErr ?></span>
            </div>

            <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-primary" >Submit</button>
                <a class="btn btn-primary" href="index.php">Revenir</a>
            </div>
            <div class="mb-3 test">
            <input type="hidden" class="form-control field left" name="id" value="<?php echo $id; ?>" readonly>
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