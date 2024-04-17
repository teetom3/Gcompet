<?php 
   include 'partials/header.php'
   ?>
<body>
  <div class="container">
    <div class="header">
      <h2>Liste des Joueurs (Admin)</h2>
    </div>
    <div class="search-bar">
      <input type="text" id="searchInput"  placeholder="Rechercher un joueur...">
      <div class="filter-bar">
    <label for="handicapRange">Filtrer par index</label>
    <span>min</span><input type="range" id="handicapMin" name="handicapMin" min="0" max="54" value="0">
    <span id="handicapMinValue">0</span>
    <input type="range" id="handicapMax" name="handicapMax" min="0" max="54" value="54">
    <span id="handicapMaxValue">54</span><span>max</span>
</div>
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
         
        </tbody>
      </table>
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
// Événement onChange pour la barre de filtre handicap (minimum)
$('#handicapMin').on('input', function() {
    var min = parseInt($(this).val());
    var max = parseInt($('#handicapMax').val());
    $('#handicapMinValue').text(min);
    filterPlayersByHandicap(min, max);
});

// Événement onChange pour la barre de filtre handicap (maximum)
$('#handicapMax').on('input', function() {
    var min = parseInt($('#handicapMin').val());
    var max = parseInt($(this).val());
    $('#handicapMaxValue').text(max);
    filterPlayersByHandicap(min, max);
});



// Fonction pour filtrer les joueurs par handicap dans la fourchette spécifiée

function filterPlayersByHandicap(min, max){
$.ajax({
        url: 'search-players.php', // URL de votre script PHP pour filtrer les joueurs par handicap
        method: 'POST',
        data: { handicapMin: min, handicapMax: max },
        success: function(response) {
            // Mettez à jour le contenu du tableau avec les joueurs filtrés
            $('tbody').html(response);
        },
        error: function(xhr, status, error) {
            console.error(status + ': ' + error);
        }
    });
  }
</script>

</script>
</div>
<?php
  include 'partials/footer.php';
  ?>