<?php 
   include 'partials/header.php'
   ?>
      
        <div class="alert__message-succes">
          <p>
              Modifications sauvgardées
          </p>
      </div>

    <div class="event-details">
        <div class="event-image">
          <img src="./images/golf.jpg" alt="Image de l'événement">
        </div>
        <div class="event-info">
          <h1>Titre de l'événement</h1>
          <p>Description de l'événement sur plusieurs lignes...</p>
          <p><strong>Prix:</strong> 50€</p>
          <p><strong>Places restantes:</strong> 20</p>
          <button>S'inscrire</button>
        </div>
      </div>

      <div class="container">
        <div class="header">
          <h2>Liste des Joueurs</h2>
        </div>
        <div class="search-bar">
          <input type="text" placeholder="Rechercher un joueur...">
        </div>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Avatar</th>
                <th>Prénom</th>
                <th>Index</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><img src="" alt="Avatar joueur 1"></td>
                <td>John</td>
                <td>10</td>
              </tr>
              <tr>
                <td><img src="./images/P1000050.JPG" alt="Avatar joueur 2"></td>
                <td>Alice</td>
                <td>15</td>
              </tr>
              <tr>
                <td><img src="avatar3.jpg" alt="Avatar joueur 3"></td>
                <td>Michael</td>
                <td>12</td>
              </tr>
              <!-- Ajoutez plus de lignes pour plus de joueurs -->
            </tbody>
          </table>
        </div>
        <?php 
   include 'partials/header.php'
   ?>