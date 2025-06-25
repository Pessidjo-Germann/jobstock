<?php
include('./conbd.php'); 
include('../includes/email_verification.php');

session_start();

$emailVerification = new EmailVerification($link);

$user_email = mysqli_real_escape_string($link, $_POST["user_email"]);
$password_email = mysqli_real_escape_string($link, $_POST["password_email"]);

// Vérifier si l'email existe
$sql_verification = "SELECT * FROM `users` WHERE `email` = '".$user_email."'";
$query_verification = mysqli_query($link,$sql_verification);	
$nblignes_verification=mysqli_num_rows($query_verification);	

if($nblignes_verification==0){
    $message = '../signup.php?message="Compte introuvable dans notre base de données"';
    header("Location: " . $message);
    exit;
}

// Vérifier le mot de passe
$sql = "SELECT * FROM `users` WHERE `email` = '".$user_email."' AND `password` ='".$password_email."'";
$query = mysqli_query($link,$sql);	
$nblignes=mysqli_num_rows($query);	

if($nblignes>0){
    // Mot de passe correct, demander la vérification par email
    $_SESSION['verification_email'] = $user_email;
    $_SESSION['verification_action'] = 'login';
    $_SESSION['verification_password'] = $password_email; // Pour validation ultérieure
    
    // Générer et envoyer le code de vérification
    $verification_code = $emailVerification->generateVerificationCode();
    
    if ($emailVerification->saveVerificationCode($user_email, $verification_code, 'login')) {
        if ($emailVerification->sendVerificationEmail($user_email, $verification_code, 'login')) {
            $_SESSION['code_sent_time'] = time();
            header('location:../email_verification.php?message="Un code de vérification a été envoyé à votre adresse email"');
            exit;
        } else {
            header('location:../signup.php?message="Erreur lors de l\'envoi de l\'email de vérification"');
            exit;
        }
    } else {
        header('location:../signup.php?message="Erreur lors de la génération du code de vérification"');
        exit;
    }
} else {
    header("location:../signup.php?message=\"Mot de passe incorrect\"");
    exit;
}