<?php



// Inclure le fichier de configuration de la base de données et d'autres fichiers nécessaires
require_once 'config/database.php';

// Vérifier si les paramètres d'URL nécessaires sont définis
if (isset($_GET['id_evenement']) && isset($_GET['id_utilisateur'])) {
    // Récupérer les valeurs des paramètres d'URL
    $id_evenement = $_GET['id_evenement'];
    $id_utilisateur = $_GET['id_utilisateur'];
    // Requête SQL pour inscrire le joueur dans la liste des inscrits
    $query = "INSERT INTO inscriptions (id_evenement, id_utilisateur) VALUES ($id_evenement, $id_utilisateur)";
    // Exécuter la requête
    $result = mysqli_query($connection, $query);
    if ($result) {
        // Rediriger vers une page de confirmation ou autre
        $_SESSION['inscription_success'] = "Le joueur a été inscrit avec succès.";
        header('Location: ' . ROOT_URL .'admin/inscrire-joueurs.php?id=' . $id_evenement);
        exit(); // Terminer le script après la redirection
    } else {
        // Gérer l'erreur si la requête échoue
        $_SESSION['inscription_error'] = "Erreur lors de l'inscription du joueur : " . mysqli_error($connection);
        header('Location: ' . ROOT_URL .'admin/inscrire-joueurs.php?id=' . $id_evenement);
        exit(); // Terminer le script après la redirection
    }
} else {
    // Rediriger vers une page d'erreur si les paramètres d'URL sont manquants
    $_SESSION['inscription_error'] = "Paramètres d'URL manquants pour l'inscription du joueur.";
    header('Location: ' . ROOT_URL .'admin/inscrire-joueurs.php?id=' . $id_evenement);
    exit(); // Terminer le script après la redirection
};
?>