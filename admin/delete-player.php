<?php

// Connexion à la base de données
require 'config/database.php';

if(isset($_GET['id_utilisateur'])) {
    // Récupérer l'ID de l'utilisateur à supprimer
    $id_utilisateur = $_GET['id_utilisateur'];

    // Requête SQL pour sélectionner l'avatar de l'utilisateur
    $query_select_avatar = "SELECT avatar FROM users WHERE id = $id_utilisateur";
    $result_select_avatar = mysqli_query($connection, $query_select_avatar);
    if($result_select_avatar && mysqli_num_rows($result_select_avatar) > 0) {
        $row_avatar = mysqli_fetch_assoc($result_select_avatar);
        $avatar_filename = $row_avatar['avatar'];
        
        // Supprimer l'avatar de l'utilisateur s'il existe
        if(!empty($avatar_filename)) {
            $avatar_path = "../images/" . $avatar_filename;
            if(file_exists($avatar_path)) {
                unlink($avatar_path); // Supprimer le fichier avatar
            }
        }
    }

    

    // Vérifier si l'utilisateur est inscrit à des événements avant de supprimer les inscriptions
    $query_check_inscriptions = "SELECT * FROM inscriptions WHERE id_utilisateur = $id_utilisateur";
    $result_check_inscriptions = mysqli_query($connection, $query_check_inscriptions);
    
    // S'il existe des inscriptions pour cet utilisateur, supprimer les inscriptions
    if(mysqli_num_rows($result_check_inscriptions) > 0) {
        $query_delete_inscriptions = "DELETE FROM inscriptions WHERE id_utilisateur = $id_utilisateur";
        $result_delete_inscriptions = mysqli_query($connection, $query_delete_inscriptions);
    }
// Requête SQL pour supprimer l'utilisateur de la table 'users'
$query_delete_user = "DELETE FROM users WHERE id = $id_utilisateur";
$result_delete_user = mysqli_query($connection, $query_delete_user);

    // Vérifier si les suppressions ont été effectuées avec succès
    if($result_delete_user !== false) {
        // Stocker un message de confirmation dans $_SESSION
        $_SESSION['success_message'] = "L'utilisateur a été supprimé avec succès.";
    } else {
        // Stocker un message d'erreur dans $_SESSION
        $_SESSION['error_message'] = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
    }
} else {
    // Redirection si l'ID de l'utilisateur n'est pas spécifié dans l'URL
    $_SESSION['error_message'] = "L'identifiant de l'utilisateur n'a pas été spécifié.";
}

// Redirection vers une autre page
header('Location: ' . ROOT_URL .'admin/manage-utilisateurs.php');
exit();

// Fermer la connexion à la base de données
mysqli_close($connection);
?>
