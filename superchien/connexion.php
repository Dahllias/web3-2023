<?php
session_start();
?>
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
<?php
if($_SERVER["REQUEST_METHOD"] != "POST"){
    $_SESSION['connexion'] =false;
}
if($_SESSION['connexion']==false){
    $username = $email = $password = "";

    $usernameErr = $emailErr = $passwordErr = $ConnexionErr ="";

    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //echo "POST";
        //Si on entre, on est dans l'envoie du formulaires

        if (empty($_POST['username'])) {
            $usernameErr = "Le username ou email est requis";
            $erreur = true;
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($_POST['password'])) {
            $passwordErr = "Le password est requis";
            $erreur = true;
        } else {
            $password = test_input($_POST["password"]);
        }
        if ($erreur == false) {
    ?>
    <?php 
    $username=$_POST['username'];
    $password=$_POST['password'];

    $password=sha1($password,false);

    $servername = "localhost";
    $usernameBD = "root";
    $passwordBD = "root";
    $BDname = "bdtest";
    
    $conn = new mysqli($servername, $usernameBD, $passwordBD, $BDname);
    
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    //$sql = "SELECT * FROM usagers WHERE user ='$username' and password = '$password' OR WHERE email = '$username' and password = '$password'";
    $sql = "SELECT * FROM usagers WHERE user = '$username' AND password = '$password'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    echo "<h1>Connecté</h1>";
    $_SESSION["connexion"] = true;
    header("location:index.php");
}else{
    $sql = "SELECT * FROM usagers WHERE email = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["connexion"] = true;
        header("location:index.php");
    } else {
        $erreur = true;
        $ConnexionErr="Nom d'usager ou mot de passe invalide";
    }
}


$conn->close();
?>
<?php
        }
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {


        ?>
        <form class="row" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3 col-12">
                <label for="exampleInputUsername1" class="form-label">Username ou Email</label>
                <input type="name" class="form-control" id="exampleInputUsername1" name="username">
                <span style="color:red"><?php echo $usernameErr ?></span> 
            </div>
            <div class="mb-3 col-12">
                
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                <span style="color:red"><?php echo $passwordErr ?></span>
                <span style="color:red"><?php echo $ConnexionErr ?></span>
            </div>
            
            <div class="col-md-6 mb-3">
            <a href="compte.php"class="btn btn-primary" href="">Créer un compte</a>
            <button type="submit" class="btn btn-primary" >Connexion</button>
            </div>
        </form>

    <?php
    }
}
else{
    header("location:index.php");
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