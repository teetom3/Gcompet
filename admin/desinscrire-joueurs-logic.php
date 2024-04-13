<?php
// Inclure le fichier de configuration de la base de données et d'autres fichiers nécessaires
require_once 'config/database.php';

// Vérifier si les paramètres d'URL nécessaires sont définis
if (isset($_GET['id_evenement']) && isset($_GET['id_utilisateur'])) {
    // Récupérer les valeurs des paramètres d'URL
    $id_evenement = $_GET['id_evenement'];
    $id_utilisateur = $_GET['id_utilisateur'];

   

    // Requête SQL pour supprimer l'inscription du joueur à l'événement
    $query = "DELETE FROM inscriptions WHERE id_evenement = $id_evenement AND id_utilisateur = $id_utilisateur";
    
    // Exécuter la requête
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Rediriger vers une page de confirmation ou autre
        $_SESSION['desinscription_success'] = "Le joueur a été désinscrit avec succès.";
        header('Location: ' . ROOT_URL . 'admin/manage-event.php?id=' . $id_evenement);
        exit(); // Terminer le script après la redirection
    } else {
        // Gérer l'erreur si la requête échoue
        $_SESSION['desinscription_error'] = "Erreur lors de la désinscription du joueur : " . mysqli_error($connection);
        header('Location: ' . ROOT_URL . 'admin/manage-event.php?id=' . $id_evenement);
        exit(); // Terminer le script après la redirection
    }
} else {
    // Rediriger vers une page d'erreur si les paramètres d'URL sont manquants
    $_SESSION['desinscription_error'] = "Paramètres d'URL manquants pour la désinscription du joueur.";
    header('Location: ' . ROOT_URL . 'admin/manage-event.php?id=' . $id_evenement);
    exit(); // Terminer le script après la redirection
}
?>
