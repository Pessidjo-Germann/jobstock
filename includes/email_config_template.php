<?php
/**
 * Configuration SMTP pour l'envoi d'emails
 * 
 * INSTRUCTIONS DE CONFIGURATION :
 * 
 * 1. Pour GMAIL :
 *    - Activez la vérification en 2 étapes : https://myaccount.google.com/security
 *    - Générez un mot de passe d'application : https://myaccount.google.com/apppasswords
 *    - Remplacez 'votre-email@gmail.com' et 'votre-mot-de-passe-app' ci-dessous
 * 
 * 2. Pour OUTLOOK/HOTMAIL :
 *    - Utilisez votre email et mot de passe habituels
 *    - Changez smtp_host vers 'smtp-mail.outlook.com'
 * 
 * 3. Pour YAHOO :
 *    - Générez un mot de passe d'application Yahoo
 *    - Changez smtp_host vers 'smtp.mail.yahoo.com'
 */

return [
    // Configuration SMTP
    'smtp_host' => 'smtp.gmail.com', // Gmail: smtp.gmail.com | Outlook: smtp-mail.outlook.com | Yahoo: smtp.mail.yahoo.com
    'smtp_port' => 587,              // Port standard pour TLS
    'smtp_secure' => 'tls',          // 'tls' ou 'ssl'
    'smtp_auth' => true,             // Authentification requise
    
    // ⚠️  MODIFIEZ CES VALEURS AVEC VOS VRAIES DONNÉES ⚠️
    'smtp_username' => 'VOTRE_EMAIL@gmail.com',        // Votre adresse email complète
    'smtp_password' => 'VOTRE_MOT_DE_PASSE_APPLICATION', // Mot de passe d'application (Gmail) ou mot de passe normal
    
    // Informations de l'expéditeur (utilisées dans les emails envoyés)
    'from_email' => 'noreply@digexbooker.com',  // Peut être différent de smtp_username
    'from_name' => 'Digex Booker',               // Nom affiché comme expéditeur
    
    // Options de débogage (pour diagnostiquer les problèmes)
    'debug_mode' => false,  // true pour activer les logs détaillés
    'debug_level' => 0      // 0 = pas de debug, 1 = erreurs, 2 = messages, 3 = connexion, 4 = données
];

/*
EXEMPLE DE CONFIGURATION GMAIL :
return [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_secure' => 'tls',
    'smtp_auth' => true,
    'smtp_username' => 'moncompte@gmail.com',
    'smtp_password' => 'abcd efgh ijkl mnop',  // Mot de passe d'application à 16 caractères
    'from_email' => 'noreply@digexbooker.com',
    'from_name' => 'Digex Booker',
    'debug_mode' => false,
    'debug_level' => 0
];

EXEMPLE DE CONFIGURATION OUTLOOK :
return [
    'smtp_host' => 'smtp-mail.outlook.com',
    'smtp_port' => 587,
    'smtp_secure' => 'tls',
    'smtp_auth' => true,
    'smtp_username' => 'moncompte@outlook.com',
    'smtp_password' => 'mon_mot_de_passe',
    'from_email' => 'noreply@digexbooker.com',
    'from_name' => 'Digex Booker',
    'debug_mode' => false,
    'debug_level' => 0
];
*/
?>
