<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <?php
  $nom = $lien = $mdp = $cmdp = $email = $date = $transport = $radio = $validemdp = "";

  $nomErr = $lienErr = $mdpErr = $cmdpErr = $emailErr = $dateErr = $transportErr = $radioErr = "";

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

    if (empty($_POST['mdp'])) {
      $mdpErr = "Le mot de passe est requis";
      $erreur = true;
    } else {
      $mdp = test_input($_POST["mdp"]);
    }

    if (empty($_POST['cmdp'])) {
      $cmdpErr = "La confirmation est requise";
      $erreur = true;
    } else {
      $cmdp = test_input($_POST["cmdp"]);
    }

    if ($_POST['mdp'] != $_POST['cmdp']) {
      $validemdp = "Les mots de passe ne sont pas identiques";
      $erreur = true;
    }

    if (empty($_POST['email'])) {
      $emailErr = "Le email est requis";
      $erreur = true;
    } else {
      $email = validateEmail($_POST["email"]);
    }

    if (empty($_POST['date'])) {
      $dateErr = "La date est requise";
      $erreur = true;
    } else {
      $date = test_input($_POST["date"]);
    }

    if (empty($_POST['radio'])) {
      $radioErr = "Le sexe est requis";
      $erreur = true;
    } else {
      $radio = test_input($_POST["radio"]);
    }

    if (empty($_POST['transport'])) {
      $transportErr = "Le choix de transport est requis";
      $erreur = true;
    } else {
      $transport = test_input($_POST["transport"]);
    }
    if($erreur == false){
?>
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $_POST['lien'];?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $_POST['nom'];?></h5>
    <p class="card-text"><?php echo $_POST['email'];?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><p>Sexe:</p><?php echo $_POST['radio'];?></li>
    <li class="list-group-item"><?php echo $_POST['transport'];?></li>
    <li class="list-group-item"><?php echo $_POST['date'];?></li>
  </ul>
  <div class="card-body">
    <a href="index.php" class="btn btn-primary">Créer le compte</a>
  </div>
</div>
 
    <?php
    }
  }
  if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
    

  ?>
    <form class="row" method="post">
      <div class="col-md-4 mb-3">
        <label for="exampleInputName1" class="form-label">Nom</label>
        <input type="name" class="form-control" id="exampleInputName1" name="nom">
        <span><?php echo $nomErr ?></span>
      </div>
      <div class="col-md-8 mb-3">
        <label for="exampleInputLink1" class="form-label">Lien vers une image avatar </label>
        <input type="url" class="form-control" id="exampleInputLink1" name="lien">
        <span><?php echo $lienErr ?></span>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="mdp">
        <span><?php echo $mdpErr ?></span>
      </div>
      <span><?php echo $validemdp ?></span>
      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Confirmation mot de passe</label>
        <input type="password" class="form-control" id="exampleInputPassword2" name="cmdp">
        <span><?php echo $cmdpErr ?></span>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Adresse courriel</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        <span><?php echo $emailErr ?></span>
      </div>
      <div class="mb-3">
        <label for="exampleInputDate1" class="form-label">Date de naissance</label>
        <input type="date" class="form-control" id="exampleInputDate1" name="date">
        <span><?php echo $dateErr ?></span>
      </div>
      <div class="col-md-3 mb-3">
        <label for="" class="form-label">Sexe </label></br>
        <input type="radio" id="masculin" name="radio" value="Masculin" <?php echo ($radio == "masculin") ? "checked" : "" ?>>
        <label for="masculin">Masculin</label><br>
        <input type="radio" id="féminin" name="radio" value="Féminin" <?php echo ($radio == "féminin") ? "checked" : "" ?>>
        <label for="féminin">Féminin</label><br>
        <input type="radio" id="nongenré" name="radio" value="Non-genré" <?php echo ($radio == "nongenré") ? "checked" : "" ?>>
        <label for="nongenré">Non genré</label><br>
        <span><?php echo $radioErr ?></span>
      </div>
      <div class="col-md-9 mb-3">
        <label for="choixTransport">Mode de transport:</label>
        <select name="transport" id="choixTransport">
          <option value="voiture">Voiture</option>
          <option value="Autobus">Autobus</option>
          <option value="marche">Marche</option>
          <option value="vélo">Vélo</option>
        </select>
      </div>


      <div class="col-md-6 mb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
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

  function validateEmail($email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>