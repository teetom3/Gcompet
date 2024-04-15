<?php
// Inclure le fichier de configuration de la base de données et démarrer la session
require_once 'config/database.php';


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les données du formulaire sont présentes et non vides
    if (isset($_SESSION['user_id']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_de_naissance']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['adresse']) && isset($_POST['numero_licence']) && isset($_POST['index_golf'])) {
        // Récupérer les données du formulaire
        $id_utilisateur = $_SESSION['user_id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_de_naissance'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $numero_licence = $_POST['numero_licence'];
        $index_golf = $_POST['index_golf'];

        // Vérifier si un fichier d'avatar a été téléchargé et est valide
        if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            // Récupérer les informations sur le fichier d'avatar
            $avatar_file = $_FILES['avatar'];
            $avatar_name = $avatar_file['name'];
            $avatar_tmp_name = $avatar_file['tmp_name'];
            $avatar_size = $avatar_file['size'];
            $avatar_type = $avatar_file['type'];

            // Vérifier le type de fichier
            $allowed_types = array('image/jpeg', 'image/png', 'image/jpg');
            if(!in_array($avatar_type, $allowed_types)) {
                $_SESSION['modification_error'] = "Seuls les fichiers JPEG, PNG et JPG sont autorisés.";
                header('Location: ' . ROOT_URL . 'mon_profil.php');
                exit();
            }

            // Vérifier la taille du fichier (5 Mo maximum)
            $max_size = 5 * 1024 * 1024; // 5 Mo en octets
            if($avatar_size > $max_size) {
                $_SESSION['modification_error'] = "La taille du fichier ne doit pas dépasser 5 Mo.";
                header('Location: ' . ROOT_URL . 'mon_profil.php');
                exit();
            }

            // Générer un nom de fichier unique en ajoutant un timestamp
            $avatar_extension = pathinfo($avatar_name, PATHINFO_EXTENSION);
            $avatar_new_name = 'avatar_' . date('YmdHis') . '.' . $avatar_extension;

            // Chemin de stockage pour l'avatar
            $target_dir = "images/";
            $avatar_path = $target_dir . $avatar_new_name;

            $query_avatar = "SELECT avatar FROM users WHERE id = $id_utilisateur";
            $result_avatar = mysqli_query($connection, $query_avatar);
            $row_avatar = mysqli_fetch_assoc($result_avatar);
            $old_avatar_name = $row_avatar['avatar'];
                    
                    
                        $old_avatar_path ="images/" . $old_avatar_name;
                        if($old_avatar_path){
                            unlink($old_avatar_path);
                        } 


            

            // Déplacer le nouveau fichier d'avatar vers le répertoire de stockage
            if(move_uploaded_file($avatar_tmp_name, $avatar_path)) {
                // Mettre à jour le chemin de l'avatar dans la base de données
                $query = "UPDATE users SET avatar = '$avatar_new_name' WHERE id = $id_utilisateur";
                mysqli_query($connection, $query);
            } else {
                // Erreur lors du téléversement de l'avatar
                $_SESSION['modification_error'] = "Erreur lors du téléversement de l'avatar.";
                header('Location: ' . ROOT_URL . 'mon_profil.php');
                exit();
            }
        }

        // Requête SQL pour mettre à jour les autres informations de l'utilisateur
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
    header('Location: ' . ROOT_URL .'mon_profil.php');
    exit();
}

// Rediriger vers la page précédente en fonction du résultat de la modification
header('Location: ' . ROOT_URL .'mon_profil.php');
exit();
?>
