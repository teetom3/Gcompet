<?php
require './config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gcompet</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="signin-container">
        <img class="logo" src="./images/logo-transparent-png.png">
        <div class="signin-form">
          <h2>Connexion</h2>
          <?php if(isset($_SESSION['signup-success'])):?>
            <div class="alert__message-success">
            <p>
                <?=$_SESSION['signup-success'] ;
                unset($_SESSION['signup-success'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['signin'])):?>
            <div class="alert__message-error">
            <p>
                <?=$_SESSION['signin'] ;
                unset($_SESSION['signin'])?>
            </p>
        </div>
         <?php endif ?>   
          <form form action="<?= ROOT_URL ?>signin-logic.php" method="POST" >
            <div class="form-group">
              <label for="email">Email :</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="password">Mot de passe :</label>
              <input type="password" id="password" name="password" required>
              
            </div>
            <div class="form-group">
            <label for="email">Afficher le mot de passe</label>
            <input type="checkbox" id="showPassword"> 
            </div>
            <button type="submit" name="submit">Connexion</button>
          </form>
          <p class="signup-text">Vous n'avez pas de compte ? <a href="signup.php">Cliquez ici</a> pour vous inscrire.</p>
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