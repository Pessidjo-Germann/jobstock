<?php
/**
 * Test direct de l'endpoint Gemini
 */

// Simuler une session d'utilisateur connecté
session_start();
$_SESSION['connect'] = ['id' => 1, 'prenom' => 'Test', 'email' => 'test@test.com'];

// Données de test
$testData = [
    'question' => 'Comment rédiger un bon CV ?'
];

// Simulation de la requête POST
$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['CONTENT_TYPE'] = 'application/json';

// Simuler php://input
$jsonData = json_encode($testData);
file_put_contents('php://temp', $jsonData);

echo "=== Test de l'endpoint Gemini ===\n\n";
echo "Question test: " . $testData['question'] . "\n\n";

// Buffer la sortie pour capturer la réponse
ob_start();

// Changer le répertoire de travail vers actions/
chdir('actions');

// Simuler les données POST JSON
$_POST = [];
file_put_contents('php://memory', $jsonData);

// Test direct du fichier
try {
    // Inclure le fichier et capturer la sortie
    $GLOBALS['test_json_input'] = $jsonData;
    
    // Créer un fichier temporaire avec les données JSON
    $tempFile = tempnam(sys_get_temp_dir(), 'gemini_test');
    file_put_contents($tempFile, $jsonData);
    
    echo "Appel de l'endpoint...\n";
    
    // Exécuter via curl simulé ou include
    include 'gemini_ask.php';
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
}

$output = ob_get_clean();
echo "Réponse de l'endpoint:\n";
echo $output . "\n";
?>
