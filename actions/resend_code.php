<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include('./conbd.php');
include('../includes/email_verification.php');

$emailVerification = new EmailVerification($link);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $action_type = mysqli_real_escape_string($link, $_POST['action_type']);
    
    // Vérifier que l'utilisateur n'abuse pas du système (max 1 envoi toutes les 60 secondes)
    if (isset($_SESSION['code_sent_time']) && (time() - $_SESSION['code_sent_time']) < 60) {
        $remaining = 60 - (time() - $_SESSION['code_sent_time']);
        header("location: ../email_verification.php?message=\"Veuillez attendre $remaining secondes avant de renvoyer un code\"");
        exit;
    }
    
    // Générer et sauvegarder un nouveau code
    $verification_code = $emailVerification->generateVerificationCode();
    
    $user_data = null;
    if ($action_type === 'register' && isset($_SESSION['user_registration_data'])) {
        $user_data = $_SESSION['user_registration_data'];
    }
    
    if ($emailVerification->saveVerificationCode($email, $verification_code, $action_type, $user_data)) {
        // Envoyer l'email
        if ($emailVerification->sendVerificationEmail($email, $verification_code, $action_type)) {
            $_SESSION['code_sent_time'] = time();
            header("location: ../email_verification.php?message=\"Un nouveau code a été envoyé à votre adresse email\"");
            exit;
        } else {
            // Récupérer le dernier message d'erreur pour plus de détails
            $lastError = $emailVerification->getLastError();
            $errorMsg = !empty($lastError) ? $lastError : "Erreur lors de l'envoi de l'email. Vérifiez votre configuration SMTP.";
            header("location: ../email_verification.php?message=\"" . urlencode($errorMsg) . "\"");
            exit;
        }
    } else {
        header("location: ../email_verification.php?message=\"Erreur lors de la génération du code\"");
        exit;
    }
} else {
    header("location: ../signup.php");
    exit;
}
?>
