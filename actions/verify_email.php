<?php
session_start();
include('./conbd.php');
include('../includes/email_verification.php');

$emailVerification = new EmailVerification($link);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $verification_code = mysqli_real_escape_string($link, $_POST['verification_code']);
    $action_type = mysqli_real_escape_string($link, $_POST['action_type']);
    
    // Vérifier le code
    $verification = $emailVerification->verifyCode($email, $verification_code);
    
    if ($verification) {
        // Code valide
        if ($action_type === 'login') {
            // Processus de connexion
            $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
            $query = mysqli_query($link, $sql);
            
            if ($query && mysqli_num_rows($query) > 0) {
                $user_data = mysqli_fetch_array($query);
                $_SESSION['connect'] = $user_data;
                
                // Décoder les données sociales
                $json_data = $_SESSION['connect']['social'];
                $data_network = json_decode($json_data, true);
                $_SESSION['connect']['network'] = $data_network;
                
                // Nettoyer les sessions de vérification
                unset($_SESSION['verification_email']);
                unset($_SESSION['verification_action']);
                unset($_SESSION['verification_password']);
                unset($_SESSION['code_sent_time']);
                
                header("location: ../user/");
                exit;
            } else {
                header("location: ../email_verification.php?message=\"Erreur lors de la connexion\"");
                exit;
            }
            
        } elseif ($action_type === 'register') {
            // Processus d'inscription
            if ($verification['user_data']) {
                $user_data = json_decode($verification['user_data'], true);
                
                // Insérer l'utilisateur
                mysqli_autocommit($link, false);
                
                $nom = mysqli_real_escape_string($link, $user_data['nom']);
                $prenom = mysqli_real_escape_string($link, $user_data['prenom']);
                $email = mysqli_real_escape_string($link, $user_data['email']);
                $number = mysqli_real_escape_string($link, $user_data['number']);
                $sexe = mysqli_real_escape_string($link, $user_data['sexe']);
                $pays = mysqli_real_escape_string($link, $user_data['pays']);
                $ville = mysqli_real_escape_string($link, $user_data['ville']);
                $password = mysqli_real_escape_string($link, $user_data['password']);
                $type = mysqli_real_escape_string($link, "user");
                $langue = mysqli_real_escape_string($link, "francais");
                $abonnement = mysqli_real_escape_string($link, "starter");
                $created_at = mysqli_real_escape_string($link, date('Y-m-d H:i:s'));
                
                $sql = "INSERT INTO `users`(`nom`, `prenom`, `email`, `number`, `sexe`, `password`, 
                                          `type`, `langue`, `ville`, `pays`, `abonnement`, `created_at`, `updated_at`) 
                        VALUES ('$nom', '$prenom', '$email', '$number', '$sexe', '$password', 
                                '$type', '$langue', '$ville', '$pays', '$abonnement', '$created_at', '$created_at')";
                
                $query = mysqli_query($link, $sql);
                $last_id = $link->insert_id;
                
                if ($query) {
                    mysqli_commit($link);
                    
                    // Connecter automatiquement l'utilisateur
                    $_SESSION['connect']['id'] = $last_id;
                    
                    // Nettoyer les sessions de vérification
                    unset($_SESSION['verification_email']);
                    unset($_SESSION['verification_action']);
                    unset($_SESSION['user_registration_data']);
                    unset($_SESSION['code_sent_time']);
                    
                    header('location: ../user/profile.php');
                    exit;
                } else {
                    mysqli_rollback($link);
                    header("location: ../email_verification.php?message=\"Erreur lors de la création du compte\"");
                    exit;
                }
            } else {
                header("location: ../signup.php?message=\"Données d'inscription manquantes\"");
                exit;
            }
        }
        
    } else {
        // Code invalide ou expiré
        header("location: ../email_verification.php?message=\"Code de vérification incorrect ou expiré\"");
        exit;
    }
} else {
    header("location: ../signup.php");
    exit;
}
?>
