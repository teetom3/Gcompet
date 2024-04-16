<?php
// Inclure le fichier de configuration de la base de données et démarrer la session
require_once 'config/database.php';


// Vérifier si l'ID de l'événement est passé dans l'URL
if(isset($_GET['id'])) {
    $event_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Vérifier si l'événement existe dans la base de données
    $query_check_event = "SELECT * FROM evenements WHERE id = $event_id";
    $result_check_event = mysqli_query($connection, $query_check_event);

    if(mysqli_num_rows($result_check_event) == 0) {
        $_SESSION['modification_error'] = "L'événement spécifié n'existe pas.";
        header('Location: ' . ROOT_URL . 'admin/edit-event.php?id=' . $event_id);
        exit();
    }
} else {
    // Rediriger si l'ID de l'événement n'est pas spécifié dans l'URL
    $_SESSION['modification_error'] = "ID de l'événement non spécifié.";
    header('Location: ' . ROOT_URL . 'admin/edit-event.php?id=' . $event_id);
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Vérifier si les données du formulaire sont présentes et non vides
    if (isset($_POST['nom']) && isset($_POST['categorie']) && isset($_POST['description']) && isset($_POST['date_evenement']) && isset($_POST['places_disponibles'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $categorie = $_POST['categorie'];
        $description = $_POST['description'];
        $date = $_POST['date_evenement'];
        $places = $_POST['places_disponibles'];

        // Vérifier si une image a été téléchargée
        $image_name = "";
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Récupérer les informations sur l'image
            $image_file = $_FILES['image'];
            $image_name = $image_file['name'];
            $image_tmp_name = $image_file['tmp_name'];
            $image_size = $image_file['size'];
            $image_type = $image_file['type'];

            // Vérifier le type de fichier
            $allowed_types = array('image/jpeg', 'image/png', 'image/jpg');
            if(!in_array($image_type, $allowed_types)) {
                $_SESSION['modification_error'] = "Seuls les fichiers JPEG, PNG et JPG sont autorisés.";
                header('Location: ' . ROOT_URL . 'admin/edit-event.php?id=' . $event_id);
                exit();
            }

            // Vérifier la taille du fichier (5 Mo maximum)
            $max_size = 5 * 1024 * 1024; // 5 Mo en octets
            if($image_size > $max_size) {
                $_SESSION['modification_error'] = "La taille du fichier ne doit pas dépasser 5 Mo.";
                header('Location: ' . ROOT_URL . 'admin/edit-event.php?id=' . $event_id);
                exit();
            }

            // Générer un nom de fichier unique en ajoutant un timestamp
            $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_new_name = 'event_' . $event_id . '_' . date('YmdHis') . '.' . $image_extension;

            // Chemin de stockage pour la nouvelle image
            $target_dir = "../images/events/";
            $image_path = $target_dir . $image_new_name;

            // Supprimer l'ancienne image s'il en existe une
            $query_old_image = "SELECT image FROM evenements WHERE id = $event_id";
            $result_old_image = mysqli_query($connection, $query_old_image);
            $row_old_image = mysqli_fetch_assoc($result_old_image);
            $old_image_name = $row_old_image['image'];

            if($old_image_name && file_exists($target_dir . $old_image_name)) {
                unlink($target_dir . $old_image_name);
            }

            // Déplacer le nouveau fichier d'image vers le répertoire de stockage
            if(move_uploaded_file($image_tmp_name, $image_path)) {
                // Mettre à jour le nom de l'image dans la base de données
                $query_update_image = "UPDATE evenements SET image = '$image_new_name' WHERE id = $event_id";
                mysqli_query($connection, $query_update_image);
            } else {
                // Erreur lors du téléversement de l'image
                $_SESSION['modification_error'] = "Erreur lors du téléversement de l'image.";
                header('Location: ' . ROOT_URL . 'admin/edit-event.php?id=' . $event_id);
                exit();
            }
        }

        // Requête SQL pour mettre à jour les informations de l'événement
        $query_update_event = "UPDATE evenements SET nom = '$nom', categorie = '$categorie', description = '$description', date_evenement = '$date', places_disponibles = $places WHERE id = $event_id";

        // Exécuter la requête
        if (mysqli_query($connection, $query_update_event)) {
            // Modification réussie, stocker un message de succès dans $_SESSION
            $_SESSION['modification_success'] = "Les informations de l'événement ont été modifiées avec succès.";
        } else {
            // Erreur lors de la modification, stocker un message d'erreur dans $_SESSION
            $_SESSION['modification_error'] = "Erreur lors de la modification de l'événement : " . mysqli_error($connection);
        }
    } else {
        // Les données du formulaire sont manquantes, stocker un message d'erreur dans $_SESSION
        $_SESSION['modification_error'] = "Toutes les données du formulaire sont requises.";
    }
} else {
    // Rediriger vers la page précédente si le formulaire n'a pas été soumis
    header('Location: ' . ROOT_URL .'admin/edit-event.php?id=' . $event_id);
    exit();
}

// Rediriger vers la page précédente en fonction du résultat de la modification
header('Location: ' . ROOT_URL .'admin/edit-event.php?id=' . $event_id);
exit();
?>
