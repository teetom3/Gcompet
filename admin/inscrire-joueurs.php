<?php 
   include 'partials/header.php';
   if(isset($_GET['id'])) {
    $id_evenement = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);}

   $query ="SELECT *
FROM users
WHERE id NOT IN (
    SELECT id_utilisateur
    FROM inscriptions
    WHERE id_evenement = $id_evenement
)";

$result = mysqli_query($connection, $query);
   ?>

<div class="container">
    <div class="header">
      <h2>Inscriptions des joueurs </h2>
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Rechercher un joueur...">
    </div>
    <div class="alert__message-succes">
      <p>
          Modifications sauvgardées
      </p>
  </div>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Avatar</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Index</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($user_none = mysqli_fetch_assoc($result)) :?>
          <tr>
            <td><img src="avatar1.jpg" alt="Avatar joueur 1"></td>
            <td>Doe</td>
            <td>John</td>
            <td>john@example.com</td>
            <td>10</td>
            <td>
                <button class="inscription-button">Inscrire</button>
            </td>
          </tr>
          <?php endwhile?>
        
          <!-- Ajoutez plus de lignes pour plus de joueurs -->
        </tbody>
      </table>
    </div>

    