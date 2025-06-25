<?php
include('./conbd.php'); 
include('../includes/email_verification.php');

session_start();

$emailVerification = new EmailVerification($link);

// Récupération et validation des données
$nom = mysqli_real_escape_string($link, $_POST["nom"]);
$prenom = mysqli_real_escape_string($link, $_POST["prenom"]);
$email = mysqli_real_escape_string($link, $_POST["email"]);

// Vérifier si l'email existe déjà
$sql_verification = "SELECT * FROM `users` WHERE `email` = '".$email."'";
$query_verification = mysqli_query($link,$sql_verification);	
$nblignes_verification=mysqli_num_rows($query_verification);	
if($nblignes_verification>0){
    header('location:../signup.php?message="Email déjà utilisé"');
    exit;
}

$sexe = mysqli_real_escape_string($link, $_POST["sexe"]);
$pays = mysqli_real_escape_string($link, $_POST["pays"]);
$ville = mysqli_real_escape_string($link, $_POST["ville"]);
$password = mysqli_real_escape_string($link, $_POST["password"]);
$number = mysqli_real_escape_string($link, $_POST["number"]);

// Stocker les données d'inscription en session
$user_registration_data = array(
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email,
    'number' => $number,
    'sexe' => $sexe,
    'pays' => $pays,
    'ville' => $ville,
    'password' => $password
);

$_SESSION['user_registration_data'] = $user_registration_data;
$_SESSION['verification_email'] = $email;
$_SESSION['verification_action'] = 'register';

// Générer et envoyer le code de vérification
$verification_code = $emailVerification->generateVerificationCode();

if ($emailVerification->saveVerificationCode($email, $verification_code, 'register', $user_registration_data)) {
    if ($emailVerification->sendVerificationEmail($email, $verification_code, 'register')) {
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