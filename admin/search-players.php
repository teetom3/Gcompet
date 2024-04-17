<?php
// Connexion à la base de données
require 'config/database.php';

// Vérifier si une recherche est effectuée
if (isset($_POST['searchText'])) {
    // Nettoyer et récupérer le texte de recherche
    $searchText = mysqli_real_escape_string($connection, $_POST['searchText']);

    // Requête SQL pour rechercher des joueurs en fonction du nom, du prénom ou de l'email
    $query = "SELECT * FROM users
              WHERE nom LIKE '%$searchText%' 
              OR prenom LIKE '%$searchText%' 
              OR email LIKE '%$searchText%'";

    // Exécuter la requête
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Si des résultats sont trouvés, construire le tableau HTML des résultats
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Construire une ligne de tableau pour chaque joueur
                echo '<tr>';
                echo '<td><img src="../images/' . $row['avatar'] . '" alt="Avatar joueur"></td>';
                echo '<td>' . $row['nom'] . '</td>';
                echo '<td>' . $row['prenom'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['index_golf'] . '</td>';
                echo '<td>';
                // Bouton Modifier avec l'ID du joueur
                echo '<a href="edit-utilisateur.php?id=' . $row['id'] . '" class="edit-button"><button class="edit-button">Modifier</button></a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            // Si aucun résultat n'est trouvé, afficher un message approprié
            echo '<tr><td colspan="6">Aucun joueur trouvé</td></tr>';
        }
    } else {
        // En cas d'erreur de requête, afficher un message d'erreur
        echo '<tr><td colspan="6">Erreur de recherche</td></tr>';
    }

    // Libérer le résultat de la requête
    mysqli_free_result($result);
} else {
    // Récupérer les valeurs du filtre handicap
    $handicapMin = isset($_POST['handicapMin']) ? $_POST['handicapMin'] : 0;
    $handicapMax = isset($_POST['handicapMax']) ? $_POST['handicapMax'] : 54;

    // Requête SQL pour récupérer les joueurs dans la fourchette de handicap spécifiée
    $query = "SELECT * FROM users
              WHERE index_golf >= $handicapMin AND index_golf <= $handicapMax";

    $result = mysqli_query($connection, $query);

    if ($result) {
        // Si des résultats sont trouvés, construire le tableau HTML des résultats
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Construire une ligne de tableau pour chaque joueur
                echo '<tr>';
                echo '<td><img src="../images/' . $row['avatar'] . '" alt="Avatar joueur"></td>';
                echo '<td>' . $row['nom'] . '</td>';
                echo '<td>' . $row['prenom'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['index_golf'] . '</td>';
                echo '<td>';
                // Bouton Modifier avec l'ID du joueur
                echo '<a href="edit-utilisateur.php?id_utilisateur=' . $row['id'] . '" class="edit-button"><button class="edit-button">Modifier</button></a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            // Si aucun résultat n'est trouvé, afficher un message approprié
            echo '<tr><td colspan="6">Aucun joueur trouvé dans la fourchette de handicap spécifiée</td></tr>';
        }
    } else {
        // En cas d'erreur de requête, afficher un message d'erreur
        echo '<tr><td colspan="6">Erreur lors de la récupération des joueurs</td></tr>';
    }

    // Libérer le résultat de la requête
    mysqli_free_result($result);
}

// Fermer la connexion à la base de données
mysqli_close($connection);
?>
