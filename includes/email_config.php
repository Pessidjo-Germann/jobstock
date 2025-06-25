<?php
/**
 * Configuration SMTP pour l'envoi d'emails
 * Modifiez ces paramètres selon votre fournisseur d'email
 */
return [
    // Configuration SMTP
    'smtp_host' => 'smtp.gmail.com', // ou smtp.outlook.com, smtp.yahoo.com, etc.
    'smtp_port' => 587,
    'smtp_secure' => 'tls', // 'tls' ou 'ssl'
    'smtp_auth' => true,
    
    // Identifiants SMTP (à configurer avec vos vrais identifiants)
    'smtp_username' => 'votre-email@gmail.com', // CHANGEZ CETTE VALEUR
    'smtp_password' => 'votre-mot-de-passe-app', // CHANGEZ CETTE VALEUR (mot de passe d'application)
    
    // Informations de l'expéditeur
    'from_email' => 'noreply@digexbooker.com',
    'from_name' => 'Digex Booker',
    
    // Options de débogage
    'debug_mode' => false, // true pour activer les logs détaillés
    'debug_level' => 0 // 0 = pas de debug, 1 = erreurs, 2 = messages, 3 = connexion, 4 = données
];
?>
