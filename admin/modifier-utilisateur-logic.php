<?php
// Inclure le fichier de configuration de la base de données et démarrer la session
require_once 'config/database.php';


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les données du formulaire sont présentes et non vides
    if (isset($_POST['id_utilisateur']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_de_naissance']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['adresse']) && isset($_POST['numero_licence']) && isset($_POST['index_golf'])) {
        // Récupérer les données du formulaire
        $id_utilisateur = $_POST['id_utilisateur'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_de_naissance'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $numero_licence = $_POST['numero_licence'];
        $index_golf = $_POST['index_golf'];

        // Requête SQL pour mettre à jour les informations de l'utilisateur
        $query = "UPDATE users SET nom = '$nom', prenom = '$prenom', date_de_naissance = '$date_naissance', email = '$email', telephone = '$telephone', adresse = '$adresse', numero_licence = '$numero_licence', index_golf = '$index_golf' WHERE id = $id_utilisateur";

        // Exécuter la requête
        if (mysqli_query($connection, $query)) {
            // Modification réussie, stocker un message de succès dans $_SESSION
            $_SESSION['modification_success'] = "Les informations de l'utilisateur ont été modifiées avec succès.";
        } else {
            // Erreur lors de la modification, stocker un message d'erreur dans $_SESSION
            $_SESSION['modification_error'] = "Erreur lors de la modification des informations de l'utilisateur : " . mysqli_error($connection);
        }
    } else {
        // Les données du formulaire sont manquantes, stocker un message d'erreur dans $_SESSION
        $_SESSION['modification_error'] = "Toutes les données du formulaire sont requises.";
    }
} else {
    // Rediriger vers la page précédente si le formulaire n'a pas été soumis
    header('Location: ' . ROOT_URL .'admin/edit-utilisateur.php?id_utilisateur=' . $_POST['id_utilisateur']);
    exit();
}

// Rediriger vers la page précédente en fonction du résultat de la modification
header('Location: ' . ROOT_URL .'admin/edit-utilisateur.php?id_utilisateur=' . $_POST['id_utilisateur']);
exit();
?>