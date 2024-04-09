<?php
session_start();
require 'config/database.php';

if(isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // Valider les données du formulaire
    if (!$email || !$password) {
        $_SESSION['signin'] = 'Veuillez remplir tous les champs';
        header('Location: signin.php');
        exit();
    }

    // Vérifier l'utilisateur dans la base de données
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['mot_de_passe'])) {

            $_SESSION['user_id'] = $user['id'] ;
            // Connexion réussie, rediriger en fonction du statut de l'utilisateur
            if ($user['is_admin'] == 1) {
                $_SESSION['admin'] = true;
                header('Location: ' . ROOT_URL . 'admin/dashboard.php');
            } else {
                // Sauvegarder l'ID de l'utilisateur
                header('Location: ' . ROOT_URL . 'accueil.php');
            }
            exit();
        } else {
            $_SESSION['signin'] = 'Mot de passe incorrect';
            header('Location: ' . ROOT_URL . 'index.php');
            exit();
        }
    } else {
        $_SESSION['signin'] = 'Adresse email incorrecte ou utilisateur inexistant';
        header('Location: ' . ROOT_URL . 'index.php');
        exit();
    }
} else {
    // Rediriger vers la page de connexion si le formulaire n'a pas été soumis
    header('Location: signin.php');
    exit();
}
?>