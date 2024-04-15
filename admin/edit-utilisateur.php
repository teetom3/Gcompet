<?php 
   include 'partials/header.php';



   if(isset($_GET['id_utilisateur'])) {

    $id_utilisateur = filter_var($_GET['id_utilisateur'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id_utilisateur";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('Location: ' . ROOT_URL . 'admin/manage-utilisateurs.php');
    die();
}





   ?>
<body>
<a  href="delete-player.php?id_utilisateur=<?=$_GET['id_utilisateur']?>"class=><button class="supprimer_button">Supprimer l'utilisateur</button></a>
  <div class="profile-container">
    <div class="profile-form">
      <h2>Modifications des utilisateurs</h2>
      <?php if(isset($_SESSION['modification_success'])): ?> 
        <div class="alert__message-success">
            <p> 
                <?= $_SESSION['modification_success'];
                unset($_SESSION['modification_success'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['modification_error'])): ?> 
        <div class="alert__message-error">
            <p> 
                <?= $_SESSION['modification_error'];
                unset($_SESSION['modification_error'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['success_message'])): ?> 
        <div class="alert__message-success">
            <p> 
                <?= $_SESSION['success_message'];
                unset($_SESSION['success_message'])?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['error_message'])): ?> 
        <div class="alert__message-error">
            <p> 
                <?= $_SESSION['error_message'];
                unset($_SESSION['error_message'])?>
            </p>
        </div>
        <?php endif?>
      <form action="<?= ROOT_URL ?>admin/modifier-utilisateur-logic.php" method="POST">
      <input type="hidden" name="id_utilisateur" value="<?= $id_utilisateur ?>">
        <div class="form-group">
          <label for="nom">Nom :</label>
          <input type="text" id="nom" name="nom" value="<?=$user['nom']?>"required>
        </div>
        <div class="form-group">
          <label for="prenom">Prénom :</label>
          <input type="text" id="prenom" value="<?=$user['prenom']?>"name="prenom" required>
        </div>
        <div class="form-group">
          <label for="date_naissance">Date de naissance :</label>
          <input type="date" id="date_naissance" name="date_de_naissance" value="<?=$user['date_de_naissance']?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" id="email" name="email"  value="<?=$user['email']?>"required>
        </div>
        <div class="form-group">
          <label for="telephone">Numéro de téléphone :</label>
          <input type="tel" id="telephone" name="telephone" value="<?=$user['telephone']?>"required>
        </div>
        <div class="form-group">
          <label for="adresse">Adresse :</label>
          <input type="text" id="adresse" name="adresse" value="<?=$user['adresse']?>"required>
        </div>
        <div class="form-group">
          <label for="num_licence">Numéro de licence de FFGOLF :</label>
          <input type="text" id="numero_licence" name="numero_licence" value="<?=$user['numero_licence']?>" required>
        </div>
        <div class="form-group">
          <label for="index">Index (Classement Golf) :</label>
          <input type="text" id="index" name="index_golf" value="<?=$user['index_golf']?>"required>
        </div>
    
        <button type="submit" name="submit">Sauvegarder</button>
      </form>
      <a href="<?=ROOT_URL?>admin/manage-utilisateurs.php"><button class="quit-button">Quitter</button></a>
    </div>
    
                
  </div>
  <?php
  include 'partials/footer.php';
  ?>