<?php


// Inclure le fichier de configuration de la base de données
require 'config/database.php';

// Vérifier si l'ID de l'événement est passé dans l'URL
if(isset($_GET['id'])) {
    // Récupérer l'ID de l'événement depuis l'URL
    $id_event = $_GET['id'];

    // Requête SQL pour mettre à jour le statut de l'événement en is_active = 0
    $query = "UPDATE events SET is_active = 0 WHERE id = $id_event";

    // Exécuter la requête
    $result = mysqli_query($connection, $query);

    // Vérifier si la mise à jour a réussi
    if($result) {
        // Redirection vers une page de succès ou d'accueil
        $_SESSION['success_message'] = "L'événement a été désactivé avec succès.";
        header("Location: index.php");
        exit();
    } else {
        // En cas d'échec de la mise à jour
        $_SESSION['error_message'] = "Une erreur s'est produite lors de la désactivation de l'événement.";
        header("Location: index.php");
        exit();
    }
} else {
    // Redirection si l'ID de l'événement n'est pas spécifié dans l'URL
    $_SESSION['error_message'] = "L'identifiant de l'événement n'a pas été spécifié.";
    header("Location: index.php");
    exit();
}

// Fermer la connexion à la base de données
mysqli_close($connection);
?>
