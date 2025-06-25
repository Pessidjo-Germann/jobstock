<?php
/**
 * Test simple de l'API Gemini via l'endpoint
 */

echo "=== Test de l'endpoint Gemini ===\n\n";

// Test 1: Vérifier que le fichier existe
if (file_exists('actions/gemini_ask.php')) {
    echo "✅ Fichier actions/gemini_ask.php trouvé\n";
} else {
    echo "❌ Fichier actions/gemini_ask.php manquant\n";
    exit;
}

// Test 2: Vérifier la syntaxe PHP
$output = shell_exec('php -l actions/gemini_ask.php 2>&1');
if (strpos($output, 'No syntax errors') !== false) {
    echo "✅ Syntaxe PHP correcte\n";
} else {
    echo "❌ Erreur de syntaxe PHP:\n" . $output . "\n";
    exit;
}

// Test 3: Vérifier que gemini_config.php est accessible
if (file_exists('includes/gemini_config.php')) {
    echo "✅ Configuration Gemini trouvée\n";
} else {
    echo "❌ Configuration Gemini manquante\n";
}

// Test 4: Tester l'inclusion des fichiers
echo "\nTest d'inclusion des dépendances...\n";
try {
    require_once 'includes/gemini_config.php';
    echo "✅ gemini_config.php chargé avec succès\n";
    
    // Tester la classe GeminiAI
    $gemini = new GeminiAI();
    echo "✅ Classe GeminiAI instanciée\n";
    
} catch (Exception $e) {
    echo "❌ Erreur lors du chargement: " . $e->getMessage() . "\n";
}

echo "\n=== Test terminé ===\n";
?>
