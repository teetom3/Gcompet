<?php
// Inclure les fichiers nécessaires et démarrer la session
require 'config/database.php';
require_once 'fonctions.php';
require 'vendor/autoload.php'; // Inclure PHPMailer



// Fonction pour envoyer un e-mail avec le fichier en pièce jointe
function envoyerEmail($destinataire, $sujet, $contenu, $chemin_piece_jointe, $nom_piece_jointe)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'Gcompet2024@gmail.com'; // Remplacez par votre adresse Gmail
    $mail->Password = 'Gcompet2024.administrator'; // Remplacez par votre mot de passe Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('Gcompet2024@gmail.com', 'L\'équipe GCompet');
    $mail->addAddress($destinataire);

    $mail->isHTML(true);
    $mail->Subject = $sujet;
    $mail->Body = $contenu;
    $mail->addAttachment($chemin_piece_jointe, $nom_piece_jointe);

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}
// Récupérer l'ID de l'événement depuis l'URL
if(isset($_GET['id'])) {
    $event_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);}
// Votre code pour récupérer l'adresse e-mail de l'administrateur
$admin_id = $_SESSION['user_id'];

        // Requête SQL pour récupérer l'e-mail de l'administrateur
        $query = "SELECT email FROM users WHERE id = $admin_id";
        $result = mysqli_query($connection, $query);
        $admin = mysqli_fetch_assoc($result);
$adresse_email_administrateur = $admin['email']; // Remplir avec la méthode appropriée

// Votre code pour récupérer les numéros de licence avec une jointure SQL
// Assurez-vous de remplacer 'table_inscriptions' et 'table_users' par les noms de vos tables réelles
$query = "SELECT u.numero_licence FROM inscriptions i JOIN users u ON i.id_utilisateur = u.id WHERE i.id_evenement = $event_id";
$resultat = mysqli_query($connection, $query);

// Générer le contenu du fichier texte
$contenu_fichier = '';
while ($row = mysqli_fetch_assoc($resultat)) {
    $contenu_fichier .= $row['numero_licence'] . PHP_EOL; // Ajouter un numéro de licence par ligne
}

// Chemin et nom du fichier texte
$nom_fichier = 'liste_licences_' . date('Y-m-d_H-i-s') . '.txt';
$chemin_complet = '../images/fichier/' . $nom_fichier; // Remplacer avec le chemin approprié

// Envoyer l'e-mail avec le fichier texte en pièce jointe
if (file_put_contents($chemin_complet, $contenu_fichier)) {
    if (envoyerEmail($adresse_email_administrateur, "Liste des licences pour l'événement", "Voici la liste des licences pour l'événement.", $chemin_complet, $nom_fichier)) {
        $_SESSION['message'] = "Le fichier texte des numéros de licences a été généré et envoyé par e-mail à l'administrateur avec succès.";
    } else {
        $_SESSION['erreur'] = "Erreur lors de l'envoi de l'e-mail.";
    }
} else {
    $_SESSION['erreur'] = "Erreur lors de la génération du fichier texte.";
}

// Redirection vers la page précédente avec un message de confirmation ou d'erreur
header('Location: ' . ROOT_URL . 'admin/manage-event.php?id=' . $event_id);
exit();
?>
