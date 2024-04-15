<?php 
   include 'partials/header.php'
   ?>


<div class="container">
    <div class="header">
      <h2>Liste des Joueurs</h2>
    </div>
    <div class="search-bar">
      <input type="text" id="searchInput"  placeholder="Rechercher un joueur...">
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
          
          <!-- Ajoutez plus de lignes pour plus de joueurs -->
        </tbody>
      </table>
    </div>
</div>
<script>
$(document).ready(function() {
    // Fonction pour charger tous les joueurs lors du chargement de la page
    function loadAllPlayers() {
        $.ajax({
            url: 'search-players.php', // URL de votre script PHP pour charger tous les joueurs
            method: 'GET', // Utilisation de la méthode GET pour charger tous les joueurs
            success: function(response) {
                // Mettez à jour le contenu du tableau avec tous les joueurs
                $('tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.error(status + ': ' + error);
            }
        });
    }

    // Appeler la fonction pour charger tous les joueurs au chargement de la page
    loadAllPlayers();

    // Événement onChange pour la barre de recherche
    $('#searchInput').on('input', function() {
        var searchText = $(this).val();
        $.ajax({
            url: 'search-players.php', // URL de votre script PHP qui effectue la recherche
            method: 'POST',
            data: { searchText: searchText },
            success: function(response) {
                // Mettez à jour le contenu du tableau avec les résultats de la recherche
                $('tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.error(status + ': ' + error);
            }
        });
    });
});

</script>
    <!--------------------------------------------DEBUT DU FOOTER ------------------------------------------------------------>
    <?php 
   include 'partials/footer.php'
   ?>