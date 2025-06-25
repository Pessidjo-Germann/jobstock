<?php
/**
 * Script de test pour l'API Google Gemini
 * 
 * Ce script teste la configuration et la connexion à l'API Gemini
 * Utilisez-le pour vérifier que votre clé API fonctionne correctement
 */

require_once 'includes/gemini_config.php';

echo "=== Test de l'API Google Gemini ===\n\n";

try {
    // Vérification de la configuration
    echo "1. Vérification de la configuration...\n";
    
    if (GEMINI_API_KEY === 'YOUR_GEMINI_API_KEY_HERE') {
        throw new Exception("❌ Clé API non configurée. Veuillez modifier includes/gemini_config.php");
    }
    
    echo "✅ Clé API configurée\n";
    echo "✅ URL API: " . GEMINI_API_URL . "\n";
    echo "✅ Timeout: " . GEMINI_TIMEOUT . " secondes\n";
    echo "✅ Max tokens: " . GEMINI_MAX_TOKENS . "\n\n";
    
    // Vérification de curl
    echo "2. Vérification de curl...\n";
    if (!function_exists('curl_init')) {
        throw new Exception("❌ Extension curl non disponible");
    }
    echo "✅ Extension curl disponible\n\n";
    
    // Test de connexion
    echo "3. Test de connexion à l'API...\n";
    $gemini = new GeminiAI();
    
    $testResult = $gemini->testConnection();
    
    if ($testResult['success']) {
        echo "✅ " . $testResult['message'] . "\n";
        echo "📝 Réponse de test: " . substr($testResult['response'], 0, 100) . "...\n\n";
    } else {
        throw new Exception("❌ " . $testResult['message']);
    }
    
    // Test avec une question plus complexe
    echo "4. Test avec une question spécifique...\n";
    $testQuestion = "Peux-tu me donner 3 conseils pour réussir un entretien d'embauche ?";
    
    echo "Question: " . $testQuestion . "\n";
    
    $response = $gemini->askQuestion($testQuestion);
    
    echo "✅ Réponse reçue (" . strlen($response) . " caractères)\n";
    echo "📝 Réponse:\n" . $response . "\n\n";
    
    echo "=== Tous les tests sont passés avec succès ! ===\n";
    echo "Votre configuration Gemini est prête à être utilisée.\n\n";
    
    echo "Instructions pour utiliser l'IA sur votre site :\n";
    echo "1. Connectez-vous à votre compte\n";
    echo "2. Allez sur la page d'accueil\n";
    echo "3. Faites défiler jusqu'à la section 'Assistant IA'\n";
    echo "4. Posez vos questions !\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n\n";
    
    echo "=== Instructions de dépannage ===\n";
    echo "1. Vérifiez votre clé API Gemini dans includes/gemini_config.php\n";
    echo "2. Assurez-vous que curl est installé (sudo apt-get install php-curl)\n";
    echo "3. Vérifiez votre connexion internet\n";
    echo "4. Consultez les logs d'erreur de votre serveur web\n\n";
    
    echo "Pour obtenir une clé API Gemini :\n";
    echo "1. Allez sur https://makersuite.google.com/app/apikey\n";
    echo "2. Connectez-vous avec votre compte Google\n";
    echo "3. Créez une nouvelle clé API\n";
    echo "4. Copiez-la dans includes/gemini_config.php\n";
}
?>
