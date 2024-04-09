<?php
require 'config/database.php';

// Vérifier si le formulaire d'inscription a été soumis
if(isset($_POST['submit'])) {
    // Récupérer les données du formulaire et les filtrer
    $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
    $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
    $date_de_naissance = $_POST['date_de_naissance']; // Pas besoin de filtrer une date
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_STRING);
    $adresse = filter_var($_POST['adresse'], FILTER_SANITIZE_STRING);
    $numero_licence = filter_var($_POST['numero_licence'], FILTER_SANITIZE_STRING);
    $index_golf = filter_var($_POST['index_golf'], FILTER_SANITIZE_STRING);
    $password = $_POST['password']; // Pas besoin de filtrer un mot de passe
    $avatar = $_FILES['avatar'];

    // Valider les valeurs du formulaire
    if (!$nom || !$prenom || !$date_de_naissance || !$email || !$telephone || !$adresse || !$numero_licence || !$index_golf || !$password || !$avatar['name']) {
        $_SESSION['signup'] = 'Veuillez remplir tous les champs du formulaire';
    } elseif (strlen($password) < 8) {
        $_SESSION['signup'] = 'Le mot de passe doit contenir au moins 8 caractères';
    } else {
        // Hasher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Gérer l'avatar
        $avatar_name = ''; // Initialiser le nom de l'avatar
        $time = time(); // Rendre chaque image unique
        $avatar_name = $time . basename($avatar['name']); // Créer un nom de fichier unique
        $avatar_destination_path = 'images/' . $avatar_name; // Définir le chemin de destination

        // Vérifier le type de fichier et sa taille
        $allowed_extensions = ['png', 'jpg', 'jpeg'];
        $file_extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
        if (in_array($file_extension, $allowed_extensions) && $avatar['size'] <= 5000000) {
            // Déplacer le fichier téléchargé vers le répertoire de destination
            if (move_uploaded_file($avatar['tmp_name'], $avatar_destination_path)) {
                // Insertion de l'utilisateur dans la base de données
                $insert_user_query = "INSERT INTO users (nom, prenom, date_de_naissance, email, telephone, adresse, numero_licence, index_golf, mot_de_passe, avatar, is_admin) 
                                      VALUES ('$nom', '$prenom', '$date_de_naissance', '$email', '$telephone', '$adresse', '$numero_licence', '$index_golf', '$hashed_password', '$avatar_name', 0)";

                if (mysqli_query($connection, $insert_user_query)) {
                    $_SESSION['signup-success'] = "Inscription réussie. Veuillez vous connecter.";
                    header('Location: ' . ROOT_URL . 'index.php');
                    exit();
                } else {
                    $_SESSION['signup'] = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            } else {
                $_SESSION['signup'] = "Erreur lors du téléchargement de l'avatar. Veuillez réessayer.";
            }
        } else {
            $_SESSION['signup'] = "Le fichier doit être au format PNG, JPG ou JPEG et ne doit pas dépasser 5 Mo.";
        }
    }

    // Rediriger vers la page d'inscription avec un message d'erreur
    header('Location: ' . ROOT_URL . 'signup.php');
    exit();
} else {
    // Rediriger vers la page d'inscription si le formulaire n'a pas été soumis
    header('Location: ' . ROOT_URL . 'signup.php');
    exit();
}
?>
