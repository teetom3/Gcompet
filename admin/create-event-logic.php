<?php
require 'config/database.php';

// Vérifier si le formulaire de création d'événement a été soumis
if(isset($_POST['submit'])) {
    // Récupérer les données du formulaire et les filtrer
    $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
    $categorie = filter_var($_POST['categorie'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $date = $_POST['date']; // Pas besoin de filtrer une date
    $places = filter_var($_POST['places'], FILTER_VALIDATE_INT);
    $image = $_FILES['image'];

    // Valider les valeurs du formulaire
    if (!$nom || !$categorie || !$description || !$date || !$places) {
        $_SESSION['create-event'] = 'Veuillez remplir tous les champs du formulaire';
    } else {
        // Gérer l'image de l'événement
        $image_name = ''; // Initialiser le nom de l'image
        if ($image['name']) {
            // Définir le chemin de destination de l'image
            $image_name = time() . '_' . basename($image['name']);
            $image_destination_path = '../images/events/' . $image_name;

            // Vérifier le type de fichier et sa taille
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            $file_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
            if (in_array($file_extension, $allowed_extensions) && $image['size'] <= 5000000) {
                // Déplacer le fichier téléchargé vers le répertoire de destination
                if (!move_uploaded_file($image['tmp_name'], $image_destination_path)) {
                    $_SESSION['create-event'] = "Erreur lors du téléchargement de l'image de l'événement. Veuillez réessayer.";
                }
            } else {
                $_SESSION['create-event'] = "Le fichier doit être au format JPG, JPEG ou PNG et ne doit pas dépasser 5 Mo.";
            }
        } else {
            // Aucune image fournie, utiliser une image par défaut
            $image_name = 'golf.jpg'; // Image par défaut
        }

        // Insertion de l'événement dans la base de données
        $insert_event_query = "INSERT INTO evenements (nom, categorie, description, date_evenement, places_disponibles, image) 
                               VALUES ('$nom', '$categorie', '$description', '$date', $places, '$image_name')";

        if (mysqli_query($connection, $insert_event_query)) {
            $_SESSION['create-event-success'] = "Événement créé avec succès.";
            header('Location: ' . ROOT_URL . 'admin/dashboard.php');
            exit();
        } else {
            $_SESSION['create-event'] = "Erreur lors de la création de l'événement. Veuillez réessayer.";
        }
    }

    // Rediriger vers la page de création d'événement avec un message d'erreur
    header('Location: ' . ROOT_URL . 'admin/event-form.php');
    exit();
} else {
    // Rediriger vers la page de création d'événement si le formulaire n'a pas été soumis
    header('Location: ' . ROOT_URL . 'admin/event-form.php');
    exit();
}
?>