<?php
// Configuration email
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailVerification {
    private $link;
    private $config;
    
    public function __construct($database_connection) {
        $this->link = $database_connection;
        $this->config = require_once __DIR__ . '/email_config.php';
    }
    
    /**
     * Génère un code de vérification à 6 chiffres
     */
    public function generateVerificationCode() {
        return sprintf("%06d", mt_rand(100000, 999999));
    }
    
    /**
     * Sauvegarde le code de vérification en base
     */
    public function saveVerificationCode($email, $code, $action_type, $user_data = null) {
        // Nettoyer les anciens codes pour cet email
        $this->cleanOldCodes($email);
        
        // Calculer l'expiration (15 minutes)
        $expires_at = date('Y-m-d H:i:s', time() + (15 * 60));
        
        $email = mysqli_real_escape_string($this->link, $email);
        $code = mysqli_real_escape_string($this->link, $code);
        $action_type = mysqli_real_escape_string($this->link, $action_type);
        $user_data_json = $user_data ? mysqli_real_escape_string($this->link, json_encode($user_data)) : null;
        
        $sql = "INSERT INTO `email_verifications` (`email`, `verification_code`, `expires_at`, `action_type`, `user_data`) 
                VALUES ('$email', '$code', '$expires_at', '$action_type', " . ($user_data_json ? "'$user_data_json'" : "NULL") . ")";
        
        return mysqli_query($this->link, $sql);
    }
    
    /**
     * Vérifie un code de vérification
     */
    public function verifyCode($email, $code) {
        $email = mysqli_real_escape_string($this->link, $email);
        $code = mysqli_real_escape_string($this->link, $code);
        $current_time = date('Y-m-d H:i:s');
        
        $sql = "SELECT * FROM `email_verifications` 
                WHERE `email` = '$email' 
                AND `verification_code` = '$code' 
                AND `expires_at` > '$current_time' 
                AND `is_used` = 0 
                ORDER BY `created_at` DESC 
                LIMIT 1";
        
        $result = mysqli_query($this->link, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $verification = mysqli_fetch_assoc($result);
            
            // Marquer comme utilisé
            $update_sql = "UPDATE `email_verifications` SET `is_used` = 1 WHERE `id` = " . $verification['id'];
            mysqli_query($this->link, $update_sql);
            
            return $verification;
        }
        
        return false;
    }
    
    /**
     * Nettoie les anciens codes de vérification
     */
    private function cleanOldCodes($email) {
        $email = mysqli_real_escape_string($this->link, $email);
        $current_time = date('Y-m-d H:i:s');
        
        // Supprimer les codes expirés ou utilisés
        $sql = "DELETE FROM `email_verifications` 
                WHERE `email` = '$email' 
                AND (`expires_at` <= '$current_time' OR `is_used` = 1)";
        
        mysqli_query($this->link, $sql);
    }
    
    /**
     * Envoie le code de vérification par email avec PHPMailer
     */
    public function sendVerificationEmail($email, $code, $action_type) {
        try {
            $mail = new PHPMailer(true);
            
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host       = $this->config['smtp_host'];
            $mail->SMTPAuth   = $this->config['smtp_auth'];
            $mail->Username   = $this->config['smtp_username'];
            $mail->Password   = $this->config['smtp_password'];
            $mail->SMTPSecure = $this->config['smtp_secure'];
            $mail->Port       = $this->config['smtp_port'];
            
            // Configuration du débogage
            if ($this->config['debug_mode']) {
                $mail->SMTPDebug = $this->config['debug_level'];
                $mail->Debugoutput = 'error_log';
            }
            
            // Configuration de l'encodage
            $mail->CharSet = 'UTF-8';
            
            // Expéditeur
            $mail->setFrom($this->config['from_email'], $this->config['from_name']);
            
            // Destinataire
            $mail->addAddress($email);
            
            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = "Code de vérification - Digex Booker";
            $mail->Body = $this->getEmailTemplate($code, $action_type);
            
            // Envoyer l'email
            $result = $mail->send();
            
            if ($result) {
                error_log("Email envoyé avec succès à: " . $email);
                return true;
            } else {
                error_log("Échec de l'envoi d'email à: " . $email);
                return false;
            }
            
        } catch (Exception $e) {
            error_log("Erreur PHPMailer: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Génère le template HTML de l'email
     */
    private function getEmailTemplate($code, $action_type) {
        $action_text = $action_type == 'login' ? 'connexion' : 'création de compte';
        
        return "
        <html>
        <head>
            <title>Code de vérification</title>
        </head>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <div style='max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;'>
                <h2 style='color: #2c3e50; text-align: center;'>Digex Booker</h2>
                <h3 style='color: #3498db;'>Code de vérification pour votre $action_text</h3>
                
                <p>Bonjour,</p>
                
                <p>Vous avez demandé une $action_text sur Digex Booker. Voici votre code de vérification :</p>
                
                <div style='background-color: #f8f9fa; padding: 20px; text-align: center; border-radius: 5px; margin: 20px 0;'>
                    <h1 style='color: #2c3e50; font-size: 32px; letter-spacing: 5px; margin: 0;'>$code</h1>
                </div>
                
                <p><strong>Important :</strong></p>
                <ul>
                    <li>Ce code est valable pendant <strong>15 minutes</strong></li>
                    <li>Ne partagez jamais ce code avec quelqu'un d'autre</li>
                    <li>Si vous n'avez pas demandé cette vérification, ignorez ce message</li>
                </ul>
                
                <p>Cordialement,<br>L'équipe Digex Booker</p>
                
                <hr style='border: none; border-top: 1px solid #eee; margin: 30px 0;'>
                <p style='font-size: 12px; color: #666; text-align: center;'>
                    Ceci est un message automatique, merci de ne pas y répondre.
                </p>
            </div>
        </body>
        </html>
        ";
    }
    
    /**
     * Vérifie si un email a un code de vérification en attente
     */
    public function hasPendingVerification($email) {
        $email = mysqli_real_escape_string($this->link, $email);
        $current_time = date('Y-m-d H:i:s');
        
        $sql = "SELECT COUNT(*) as count FROM `email_verifications` 
                WHERE `email` = '$email' 
                AND `expires_at` > '$current_time' 
                AND `is_used` = 0";
        
        $result = mysqli_query($this->link, $sql);
        $row = mysqli_fetch_assoc($result);
        
        return $row['count'] > 0;
    }
}
?>
