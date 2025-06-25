<?php
/**
 * Script de diagnostic pour les problèmes d'email
 */

echo "=== DIAGNOSTIC EMAIL DIGEX BOOKER ===\n\n";

// 1. Vérification des fichiers de configuration
echo "1. Vérification des fichiers...\n";

$config_file = 'includes/email_config.php';
if (file_exists($config_file)) {
    echo "✅ Fichier de configuration trouvé\n";
    $config = include($config_file);
    
    if ($config['smtp_username'] === 'votre-email@gmail.com') {
        echo "❌ Configuration email non modifiée ! Vous devez configurer vos identifiants.\n";
        echo "   Éditez le fichier: includes/email_config.php\n\n";
        
        echo "Instructions pour Gmail :\n";
        echo "1. Activez la vérification en 2 étapes sur votre compte Google\n";
        echo "2. Générez un mot de passe d'application : https://myaccount.google.com/apppasswords\n";
        echo "3. Modifiez includes/email_config.php avec vos vraies données\n\n";
        
        echo "Exemple de configuration :\n";
        echo "  'smtp_username' => 'votre-vrai-email@gmail.com',\n";
        echo "  'smtp_password' => 'abcd efgh ijkl mnop', // mot de passe d'application\n\n";
        exit;
    } else {
        echo "✅ Configuration email personnalisée détectée\n";
    }
} else {
    echo "❌ Fichier de configuration manquant\n";
    exit;
}

// 2. Vérification de Composer et PHPMailer
echo "\n2. Vérification des dépendances...\n";

if (!file_exists('vendor/autoload.php')) {
    echo "❌ Composer non installé ou vendor/ manquant\n";
    echo "Exécutez: composer install\n";
    exit;
} else {
    echo "✅ Composer installé\n";
}

require_once 'vendor/autoload.php';

if (!class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
    echo "❌ PHPMailer non trouvé\n";
    exit;
} else {
    echo "✅ PHPMailer disponible\n";
}

// 3. Test de la classe EmailVerification
echo "\n3. Test de la classe EmailVerification...\n";

if (!file_exists('includes/email_verification.php')) {
    echo "❌ Classe EmailVerification manquante\n";
    exit;
}

// Simuler une connexion DB pour les tests
$link = null; // Nous n'allons pas tester la DB ici

try {
    require_once 'includes/email_verification.php';
    echo "✅ Classe EmailVerification chargée\n";
} catch (Exception $e) {
    echo "❌ Erreur lors du chargement : " . $e->getMessage() . "\n";
    exit;
}

// 4. Test basique de PHPMailer avec votre configuration
echo "\n4. Test de connexion SMTP...\n";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);
    
    // Configuration SMTP
    $mail->isSMTP();
    $mail->Host = $config['smtp_host'];
    $mail->SMTPAuth = $config['smtp_auth'];
    $mail->Username = $config['smtp_username'];
    $mail->Password = $config['smtp_password'];
    $mail->SMTPSecure = $config['smtp_secure'];
    $mail->Port = $config['smtp_port'];
    
    // Activer le debug pour voir les détails
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {
        echo "DEBUG: $str\n";
    };
    
    // Test de connexion (sans envoyer d'email)
    if ($mail->smtpConnect()) {
        echo "✅ Connexion SMTP réussie !\n";
        $mail->smtpClose();
    } else {
        echo "❌ Échec de la connexion SMTP\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur SMTP : " . $e->getMessage() . "\n";
    
    // Messages d'aide selon le type d'erreur
    if (strpos($e->getMessage(), 'Username and Password not accepted') !== false) {
        echo "\n💡 Solution probable :\n";
        echo "   - Vérifiez vos identifiants email\n";
        echo "   - Pour Gmail : utilisez un mot de passe d'application\n";
        echo "   - Activez la vérification en 2 étapes\n";
    } elseif (strpos($e->getMessage(), 'Connection refused') !== false) {
        echo "\n💡 Solution probable :\n";
        echo "   - Vérifiez le serveur SMTP et le port\n";
        echo "   - Vérifiez votre connexion internet\n";
    }
}

echo "\n=== FIN DU DIAGNOSTIC ===\n";
?>
