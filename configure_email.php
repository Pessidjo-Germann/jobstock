<?php
/**
 * Script interactif pour configurer l'email
 */

echo "=== CONFIGURATION EMAIL DIGEX BOOKER ===\n\n";
echo "Ce script va vous aider à configurer vos paramètres email.\n\n";

// Demander les informations à l'utilisateur
echo "Entrez votre adresse email : ";
$handle = fopen("php://stdin", "r");
$email = trim(fgets($handle));

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "❌ Adresse email invalide\n";
    exit;
}

echo "Entrez votre mot de passe d'application (pour Gmail) ou mot de passe SMTP : ";
$password = trim(fgets($handle));

if (empty($password)) {
    echo "❌ Mot de passe requis\n";
    exit;
}

// Déterminer la configuration selon le fournisseur
$domain = substr(strrchr($email, "@"), 1);
$config = [];

switch ($domain) {
    case 'gmail.com':
        $config = [
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_secure' => 'tls',
            'smtp_auth' => true,
        ];
        break;
    case 'outlook.com':
    case 'hotmail.com':
    case 'live.com':
        $config = [
            'smtp_host' => 'smtp-mail.outlook.com',
            'smtp_port' => 587,
            'smtp_secure' => 'tls',
            'smtp_auth' => true,
        ];
        break;
    case 'yahoo.com':
        $config = [
            'smtp_host' => 'smtp.mail.yahoo.com',
            'smtp_port' => 587,
            'smtp_secure' => 'tls',
            'smtp_auth' => true,
        ];
        break;
    default:
        echo "Configuration manuelle requise pour $domain\n";
        echo "Entrez le serveur SMTP : ";
        $config['smtp_host'] = trim(fgets($handle));
        echo "Entrez le port SMTP (587 par défaut) : ";
        $port = trim(fgets($handle));
        $config['smtp_port'] = empty($port) ? 587 : intval($port);
        $config['smtp_secure'] = 'tls';
        $config['smtp_auth'] = true;
        break;
}

// Générer le nouveau fichier de configuration
$newConfig = "<?php
/**
 * Configuration SMTP pour l'envoi d'emails
 * Configuré automatiquement le " . date('Y-m-d H:i:s') . "
 */
return [
    // Configuration SMTP
    'smtp_host' => '{$config['smtp_host']}',
    'smtp_port' => {$config['smtp_port']},
    'smtp_secure' => '{$config['smtp_secure']}',
    'smtp_auth' => " . ($config['smtp_auth'] ? 'true' : 'false') . ",
    
    // Identifiants SMTP
    'smtp_username' => '$email',
    'smtp_password' => '$password',
    
    // Informations de l'expéditeur
    'from_email' => '$email',
    'from_name' => 'Digex Booker',
    
    // Options de débogage
    'debug_mode' => false,
    'debug_level' => 0
];
?>";

// Sauvegarder la configuration
if (file_put_contents('includes/email_config.php', $newConfig)) {
    echo "\n✅ Configuration sauvegardée avec succès !\n\n";
    
    echo "Configuration utilisée :\n";
    echo "- Email : $email\n";
    echo "- Serveur : {$config['smtp_host']}\n";
    echo "- Port : {$config['smtp_port']}\n";
    echo "- Sécurité : {$config['smtp_secure']}\n\n";
    
    echo "🧪 Test de la configuration...\n\n";
    
    // Test automatique
    system('php diagnostic_email.php');
    
} else {
    echo "❌ Erreur lors de la sauvegarde de la configuration\n";
}

fclose($handle);
?>
