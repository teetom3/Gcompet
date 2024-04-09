<?php 
   include 'partials/header.php'
   ?>






<body>
    <div class="logo_container">
        <img class="logo"src="./images/logo-transparent-png.png" alt="">
    </div>
  <div class="profile-container">
    <div class="profile-form">
      <h2>Mon Profil</h2>
      <div class="alert__message-succes">
        <p>
            Modifications sauvgardées
        </p>
    </div>
      <form>
        <div class="form-group">
          <label for="nom">Nom :</label>
          <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-group">
          <label for="prenom">Prénom :</label>
          <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
          <label for="date_naissance">Date de naissance :</label>
          <input type="date" id="date_naissance" name="date_naissance" required>
        </div>
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="telephone">Numéro de téléphone :</label>
          <input type="tel" id="telephone" name="telephone" required>
        </div>
        <div class="form-group">
          <label for="adresse">Adresse :</label>
          <input type="text" id="adresse" name="adresse" required>
        </div>
        <div class="form-group">
          <label for="num_licence">Numéro de licence de FFGOLF :</label>
          <input type="text" id="num_licence" name="num_licence" required>
        </div>
        <div class="form-group">
          <label for="index">Index (Classement Golf) :</label>
          <input type="text" id="index" name="index" required>
        </div>
        <div class="form-group">
          <label for="password">Mot de passe :</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="photo">Photo :</label>
          <input type="file" id="photo" name="photo" accept="image/*" required>
        </div>
        <button type="submit">Sauvegarder</button>
      </form>
      <button class="quit-button">Quitter</button>
    </div>
  </div>
</body>
</html>
