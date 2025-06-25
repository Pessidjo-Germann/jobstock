<?php
// Test de configuration email
// Ce fichier peut être utilisé pour tester l'envoi d'emails

include('actions/conbd.php');
include('includes/email_verification.php');

$emailVerification = new EmailVerification($link);

// Test d'envoi d'email
$test_email = "test@example.com"; // Remplacez par un vrai email pour tester
$test_code = $emailVerification->generateVerificationCode();

echo "<h2>Test de la configuration email</h2>";
echo "<p><strong>Email de test:</strong> $test_email</p>";
echo "<p><strong>Code généré:</strong> $test_code</p>";

// Tester la sauvegarde en base
if ($emailVerification->saveVerificationCode($test_email, $test_code, 'login')) {
    echo "<p style='color: green;'>✓ Code sauvegardé en base avec succès</p>";
    
    // Tester l'envoi d'email (décommentez pour tester)
    /*
    if ($emailVerification->sendVerificationEmail($test_email, $test_code, 'login')) {
        echo "<p style='color: green;'>✓ Email envoyé avec succès</p>";
    } else {
        echo "<p style='color: red;'>✗ Erreur lors de l'envoi de l'email</p>";
        echo "<p>Vérifiez la configuration du serveur mail de votre hébergeur</p>";
    }
    */
    
    // Tester la vérification
    $verification = $emailVerification->verifyCode($test_email, $test_code);
    if ($verification) {
        echo "<p style='color: green;'>✓ Vérification du code réussie</p>";
        echo "<pre>" . print_r($verification, true) . "</pre>";
    } else {
        echo "<p style='color: red;'>✗ Erreur lors de la vérification</p>";
    }
    
} else {
    echo "<p style='color: red;'>✗ Erreur lors de la sauvegarde en base</p>";
    echo "<p>Vérifiez que la table 'email_verifications' existe dans votre base de données</p>";
}

echo "<hr>";
echo "<h3>Instructions:</h3>";
echo "<ol>";
echo "<li>Ajoutez la table 'email_verifications' à votre base de données en exécutant le script verification_codes.sql</li>";
echo "<li>Configurez le serveur mail de votre hébergeur si ce n'est pas déjà fait</li>";
echo "<li>Testez l'envoi d'email en décommentant la section correspondante dans ce fichier</li>";
echo "<li>Supprimez ce fichier en production pour des raisons de sécurité</li>";
echo "</ol>";
?>
