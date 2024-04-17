<?php
require './config/database.php';



$nom = $_SESSION['signup-data']['nom'] ?? null;
$prenom = $_SESSION['signup-data']['prenom'] ?? null;
$date_de_naissance = $_SESSION['signup-data']['date_de_naissance']?? null;
$email = $_SESSION['signup-data']['email']?? null;
$telephone = $_SESSION['signup-data']['telephone']?? null;
$adresse = $_SESSION['signup-data']['adresse']?? null;
$numero_licence = $_SESSION['signup-data']['numero_licence']?? null;
$index_golf = $_SESSION['signup-data']['index_golf']?? null;


//delete signup data session

unset($_SESSION['signup-data']);
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Gcompet</title>

</head>
<body>
  <div class="logo_container">
    <img class="logo" src="./images/logo-png.png">
  </div>
    <div class="signup-container">
        <div class="signup-form">
          <h2>Inscription</h2>
          <?php if(isset($_SESSION['signup'])): ?> <div class="alert__message-error">
            <p> 
                <?= $_SESSION['signup'];
                unset($_SESSION['signup'])?>
            </p>
        </div>
        <?php endif ?>
          <form action="<?= ROOT_URL ?>signup-logic.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" id="nom" value="<?=$nom?>" name="nom" required>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom :</label>
              <input type="text" id="prenom"value="<?=$prenom?>" name="prenom" required>
            </div>
            <div class="form-group">
              <label for="date_naissance">Date de naissance (JJ/MM/YYYY) :</label>
              <input type="date" id="date_de_naissance" value="<?=$date_de_naissance?>" name="date_de_naissance" placeholder="JJ/MM/YYYY" required>
            </div>
            <div class="form-group">
              <label for="email">Email :</label>
              <input type="text" id="email" value="<?=$email?>" name="email" required>
            </div>
            <div class="form-group">
              <label for="telephone">Numéro de téléphone :</label>
              <input type="tel" id="telephone" value="<?=$telephone?>" name="telephone" required>
            </div>
            <div class="form-group">
              <label for="adresse">Adresse :</label>
              <input type="text" id="adresse" value="<?=$adresse?>" name="adresse" required>
            </div>
            <div class="form-group">
              <label for="num_licence">Numéro de licence de FFGOLF :</label>
              <input type="text" id="numero_licence" value="<?=$numero_licence?>" name="numero_licence" required>
            </div>
            <div class="form-group">
              <label for="index">Index (Classement Golf) :</label>
              <input type="text" id="index_golf" value="<?=$index_golf?>"name="index_golf" required>
            </div>
            <div class="form-group">
              <label for="password">Mot de passe :</label>
              <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
            <label for="email">Afficher le mot de passe</label>
            <input type="checkbox" id="showPassword"> 
            </div>
            <div class="form-group">
              <label for="photo">Photo :</label>
              <input type="file" id="avatar" name="avatar" required>
            </div>
            <button type="submit" name="submit">S'inscrire</button>
          </form>
        </div>
      </div>

      <script>
      document.getElementById("showPassword").addEventListener("change", function() {
    var passwordField = document.getElementById("password");
    if (this.checked) {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
});

      </script>
</body>
</html>