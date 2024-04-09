<?php 
   include 'partials/header.php'
   ?>
<body>
    <header >
    
        
          <img class="logo_nav" src="../images/logo-png.png" alt="Logo">
       
        <nav class="nav_link">
          <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Événement</a></li>
            <li><a href="#">Liste des Joueurs</a></li>
            <li><a href="#">Mon Profile</a></li>
            <li><a href="#">Déconnexion</a></li>
            <li class="btn_nav"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
          </ul>


        </nav>
        <nav class="sidebar">
          <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Événement</a></li>
            <li><a href="#">Liste des Joueurs</a></li>
            <li><a href="#">Mon Profile</a></li>
            <li><a href="#">Déconnexion</a></li>
          </ul>
        </nav>
    </header>


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
          <tr>
            <td><img src="avatar2.jpg" alt="Avatar joueur 2"></td>
            <td>Smith</td>
            <td>Alice</td>
            <td>alice@example.com</td>
            <td>15</td>
            <td>
                <button class="inscription-button">Inscrire</button>
            </td>
          </tr>
          <tr>
            <td><img src="avatar3.jpg" alt="Avatar joueur 3"></td>
            <td>Johnson</td>
            <td>Michael</td>
            <td>michael@example.com</td>
            <td>12</td>
            <td>
              <button class="inscription-button">Inscrire</button>
              
            </td>
          </tr>
          <!-- Ajoutez plus de lignes pour plus de joueurs -->
        </tbody>
      </table>
    </div>

    