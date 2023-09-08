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
    $username = $email = $password = "";

    $usernameErr = $emailErr = $passwordErr ="";

    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //echo "POST";
        //Si on entre, on est dans l'envoie du formulaires

        if (empty($_POST['username'])) {
            $usernameErr = "Le username est requis";
            $erreur = true;
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($_POST['email'])) {
            $emailErr = "Le email est requis";
            $erreur = true;
        } else {
            $email = test_input($_POST["email"]);
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
    $email=$_POST['email'];
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

    $sql = "INSERT INTO `usagers` (`id`, `user`, `email`, `password`, `ip`, `machine`) VALUES (NULL, '$username', '$email', '$password', '', '')";
$result = $conn->query($sql);

if(mysqli_query($conn, $sql)){
    header("location:connexion.php");
}else{
    
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
                <label for="exampleInputUsername1" class="form-label">Username</label>
                <input type="name" class="form-control" id="exampleInputUsername1" name="username">
                <span style="color:red"><?php echo $usernameErr ?></span> 
            </div>
            <div class="mb-3 col-12">
                <label for="exampleInputUsername1" class="form-label">Email</label>
                <input type="name" class="form-control" id="exampleInputUsername1" name="email">
                <span style="color:red"><?php echo $emailErr ?></span> 
            </div>
            <div class="mb-3 col-12">
                
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                <span style="color:red"><?php echo $passwordErr ?></span>
            </div>
            
            <div class="col-md-6 mb-3">
            <button type="submit" class="btn btn-primary" >Créer le compte</button>
            </div>
        </form>

    <?php
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