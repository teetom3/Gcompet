<?php



require 'vendor/autoload.php';


function sendMail($to, $subject, $message) {
    // Instancier un nouvel objet PHPMailer
    $mail = new PHPMailer;

    // Configurer le serveur SMTP
    $mail->isSMTP();                                      // Utiliser SMTP
    $mail->Host = 'smtp.gmail.com';                     // Adresse du serveur SMTP
    $mail->SMTPAuth = true;                               // Activer l'authentification SMTP
    $mail->Username = 'gcompet2024@gmail.com';  // Votre adresse e-mail SMTP
    $mail->Password = 'Gcompet2024.administrator';               // Votre mot de passe SMTP
    $mail->SMTPSecure = 'tls';                            // Activer le chiffrement TLS
    $mail->Port = 587;                                    // Port SMTP (587 par défaut)

    // Définir les informations de l'expéditeur et du destinataire
    $mail->setFrom('gcompet2024@gmail.com', 'Gcompet2024');
    $mail->addAddress($to);                               // Adresse e-mail du destinataire
    $mail->isHTML(true);                                  // Définir le format du message HTML

    // Définir le sujet et le corps du message
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Envoyer l'e-mail
    if($mail->send()) {
        return true; // Email envoyé avec succès
    } else {
        return false; // Erreur lors de l'envoi de l'e-mail
    }
}


// Fonction pour récupérer l'adresse e-mail de l'administrateur connecté
function getAdminEmail($connection) {
    // Vérifier si l'administrateur est connecté
    if (isset($_SESSION['user_id'])) {
        $admin_id = $_SESSION['user_id'];

        // Requête SQL pour récupérer l'e-mail de l'administrateur
        $query = "SELECT email FROM users WHERE id = $admin_id";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['email'];
        }
    }

    return false;
}

?>
