<?php
// Inclure le fichier de configuration de la base de données et démarrer la session
require 'config/database.php';

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // Récupérer l'ID de l'utilisateur connecté
    $user_id = $_SESSION['user_id'];

    // Récupérer l'ID de l'événement à partir du formulaire (à adapter selon votre formulaire)
    $event_id = $_GET['id_evenement'];

    // Vérifier si l'utilisateur est inscrit à l'événement
    $check_query = "SELECT * FROM inscriptions WHERE id_utilisateur = $user_id AND id_evenement = $event_id";
    $check_result = mysqli_query($connection, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        // L'utilisateur est inscrit à cet événement, vérifier si la désinscription est possible (au moins 48 heures avant l'événement)
        $event_query = "SELECT date_evenement FROM evenements WHERE id = $event_id";
        $event_result = mysqli_query($connection, $event_query);

        if($event_result && mysqli_num_rows($event_result) > 0) {
            $event_row = mysqli_fetch_assoc($event_result);
            $event_date = strtotime($event_row['date']);
            $current_date = time();
            $time_diff = $event_date - $current_date;

            // Vérifier si le délai de 48 heures est respecté
            if($time_diff > 48 * 3600) { // 48 heures en secondes
                // Supprimer l'inscription de la base de données
                $delete_query = "DELETE FROM inscriptions WHERE id_utilisateur = $user_id AND id_evenement = $event_id";
                if(mysqli_query($connection, $delete_query)) {
                    $_SESSION['desinscription_success'] = "Désinscription réussie de l'événement.";
                    header('Location: ' . ROOT_URL .'event.php?id_evenement=' . $event_id);
                } else {
                    $_SESSION['desinscription_error'] = "Erreur lors de la désinscription. Veuillez réessayer.";
                    header('Location: ' . ROOT_URL .'event.php?id_evenement=' . $event_id);
                }
            } else {
                // Message d'erreur si la désinscription est tentée moins de 48 heures avant l'événement
                $_SESSION['desinscription_error'] = "Vous ne pouvez pas vous désinscrire moins de 48 heures avant l'événement. Veuillez contacter l'administrateur.";
                header('Location: ' . ROOT_URL .'event.php?id_evenement=' . $event_id);
            }
        } else {
            $_SESSION['desinscription_error'] = "Événement introuvable. Veuillez réessayer.";
            header('Location: ' . ROOT_URL .'event.php?id_evenement=' . $event_id);
        }
    } else {
        $_SESSION['desinscription_error'] = "Vous n'êtes pas inscrit à cet événement.";
        header('Location: ' . ROOT_URL .'event.php?id_evenement=' . $event_id);
    }
} else {
    $_SESSION['desinscription_error'] = "Vous devez être connecté pour vous désinscrire de l'événement.";
    header('Location: ' . ROOT_URL .'event.php?id_evenement=' . $event_id);
}

// Rediriger vers la page précédente en cas d'erreur ou de succès
header('Location: ' . ROOT_URL .'event.php?id_evenement=' . $event_id);
exit();
?>
