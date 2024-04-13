<?php
// Inclure le fichier de configuration de la base de données et démarrer la session
require 'config/database.php';


// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // Récupérer l'ID de l'utilisateur connecté
    $user_id = $_SESSION['user_id'];

    // Récupérer l'ID de l'événement à partir du formulaire (à adapter selon votre formulaire)
    $event_id = $_GET['id_evenement'];

    // Vérifier si l'utilisateur est déjà inscrit à l'événement
    $check_query = "SELECT * FROM inscriptions WHERE id_utilisateur = $user_id AND id_evenement = $event_id";
    $check_result = mysqli_query($connection, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        // L'utilisateur est déjà inscrit à cet événement
        $_SESSION['inscription_error'] = "Vous êtes déjà inscrit à cet événement.";
    } else {
        // Récupérer les détails de l'événement, y compris le nombre de places disponibles
        $event_query = "SELECT places_disponibles FROM evenements WHERE id = $event_id";
        $event_result = mysqli_query($connection, $event_query);

        if($event_result && mysqli_num_rows($event_result) > 0) {
            $event_row = mysqli_fetch_assoc($event_result);
            $places_disponibles = $event_row['places_disponibles'];

            // Vérifier si des places sont disponibles
            if($places_disponibles > 0) {
                // Inscrire l'utilisateur à l'événement
                $inscription_query = "INSERT INTO inscriptions (id_utilisateur, id_evenement) VALUES ($user_id, $event_id)";
                if(mysqli_query($connection, $inscription_query)) {
                    // Mettre à jour le nombre de places disponibles dans la base de données
                    $places_disponibles--;

                    $update_query = "UPDATE evenements SET places_disponibles = $places_disponibles WHERE id = $event_id";
                    mysqli_query($connection, $update_query);

                    // Inscription réussie
                    $_SESSION['inscription_success'] = "Inscription réussie à l'événement.";
                } else {
                    $_SESSION['inscription_error'] = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            } else {
                $_SESSION['inscription_error'] = "Désolé, toutes les places pour cet événement ont été réservées.";
            }
        } else {
            $_SESSION['inscription_error'] = "Événement introuvable. Veuillez réessayer.";
        }
    }
} else {
    $_SESSION['inscription_error'] = "Vous devez être connecté pour vous inscrire à un événement.";
}

// Rediriger vers la page précédente en cas d'erreur ou de succès
header('Location: ' . ROOT_URL .'event.php?id_evenement=' . $event_id);
exit();
?>
