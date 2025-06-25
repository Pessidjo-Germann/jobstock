<?php
/**
 * Script de test pour l'envoi d'emails avec PHPMailer
 * SUPPRIMEZ CE FICHIER EN PRODUCTION !
 */
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/actions/conbd.php';
require_once __DIR__ . '/includes/email_verification.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Email - Digex Booker</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 600px; margin: 0 auto; }
        .success { color: green; padding: 10px; background: #d4edda; border-radius: 5px; }
        .error { color: red; padding: 10px; background: #f8d7da; border-radius: 5px; }
        .info { color: blue; padding: 10px; background: #d1ecf1; border-radius: 5px; }
        input, button { padding: 10px; margin: 5px 0; display: block; width: 100%; box-sizing: border-box; }
        button { background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Test Configuration Email</h1>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test_email'])) {
            $test_email = $_POST['email'];
            
            try {
                $emailVerification = new EmailVerification($link);
                $test_code = $emailVerification->generateVerificationCode();
                
                echo "<div class='info'>📧 Tentative d'envoi vers : " . htmlspecialchars($test_email) . "</div>";
                echo "<div class='info'>🔢 Code généré : " . $test_code . "</div>";
                
                if ($emailVerification->sendVerificationEmail($test_email, $test_code, 'test')) {
                    echo "<div class='success'>✅ Email envoyé avec succès ! Vérifiez votre boîte de réception.</div>";
                } else {
                    echo "<div class='error'>❌ Échec de l'envoi de l'email. Vérifiez la configuration SMTP.</div>";
                }
                
            } catch (Exception $e) {
                echo "<div class='error'>💥 Erreur : " . htmlspecialchars($e->getMessage()) . "</div>";
            }
        }
        ?>
        
        <form method="post">
            <h3>Tester l'envoi d'email</h3>
            <input type="email" name="email" placeholder="Votre email de test" required>
            <button type="submit" name="test_email">📤 Envoyer un email de test</button>
        </form>
        
        <hr style="margin: 30px 0;">
        
        <h3>🔧 Configuration actuelle</h3>
        <?php
        $config = require_once __DIR__ . '/includes/email_config.php';
        echo "<ul>";
        echo "<li><strong>Serveur SMTP :</strong> " . htmlspecialchars($config['smtp_host']) . ":" . $config['smtp_port'] . "</li>";
        echo "<li><strong>Sécurité :</strong> " . strtoupper($config['smtp_secure']) . "</li>";
        echo "<li><strong>Authentification :</strong> " . ($config['smtp_auth'] ? '✅ Activée' : '❌ Désactivée') . "</li>";
        echo "<li><strong>Utilisateur :</strong> " . htmlspecialchars($config['smtp_username']) . "</li>";
        echo "<li><strong>Expéditeur :</strong> " . htmlspecialchars($config['from_name']) . " &lt;" . htmlspecialchars($config['from_email']) . "&gt;</li>";
        echo "</ul>";
        ?>
        
        <h3>📋 Checklist de configuration</h3>
        <ul>
            <li>✅ PHPMailer installé via Composer</li>
            <li>⚠️ Modifiez <code>includes/email_config.php</code> avec vos vrais identifiants</li>
            <li>🔐 Utilisez un mot de passe d'application pour Gmail</li>
            <li>🗑️ <strong>Supprimez ce fichier en production !</strong></li>
        </ul>
        
        <div class="info">
            <strong>💡 Note :</strong> Si vous utilisez Gmail, assurez-vous d'avoir :
            <br>1. Activé la validation en 2 étapes
            <br>2. Généré un mot de passe d'application
            <br>3. Utilisé ce mot de passe dans la configuration
        </div>
        
        <hr style="margin: 30px 0;">
        
        <h3>📞 Support</h3>
        <p>En cas de problème :</p>
        <ul>
            <li>Vérifiez les logs d'erreur PHP</li>
            <li>Testez avec un autre serveur SMTP</li>
            <li>Assurez-vous que le port n'est pas bloqué par votre hébergeur</li>
        </ul>
    </div>
</body>
</html>
