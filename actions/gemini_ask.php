<?php
session_start();
require_once '../includes/gemini_config.php';

// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['connect'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté pour utiliser l\'IA']);
    exit;
}

// Vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

// Vérification du Content-Type
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

try {
    // Récupération de la question
    $question = '';
    
    if (strpos($contentType, 'application/json') !== false) {
        // Données JSON
        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Données JSON invalides');
        }
        
        $question = isset($data['question']) ? $data['question'] : '';
    } else {
        // Données POST classiques
        $question = isset($_POST['question']) ? $_POST['question'] : '';
    }
    
    // Validation de la question
    if (empty($question)) {
        throw new Exception('Veuillez poser une question');
    }
    
    $question = trim($question);
    
    if (strlen($question) < 3) {
        throw new Exception('Votre question doit contenir au moins 3 caractères');
    }
    
    if (strlen($question) > GEMINI_MAX_QUESTION_LENGTH) {
        throw new Exception('Votre question est trop longue (maximum ' . GEMINI_MAX_QUESTION_LENGTH . ' caractères)');
    }
    
    // Protection contre le spam (limitation basique)
    $lastQuestionTime = isset($_SESSION['last_gemini_question']) ? $_SESSION['last_gemini_question'] : 0;
    $currentTime = time();
    
    if (($currentTime - $lastQuestionTime) < 10) { // 10 secondes entre chaque question
        throw new Exception('Veuillez attendre quelques secondes avant de poser une nouvelle question');
    }
    
    // Initialisation de Gemini AI
    $gemini = new GeminiAI();
    
    // Amélioration de la question pour le contexte de Digex Booker
    $contextualizedQuestion = "Tu es un assistant IA pour une plateforme d'emploi appelée 'Digex Booker'. " .
                             "Réponds de manière professionnelle et utile. Si la question concerne l'emploi, " .
                             "les candidatures, ou la recherche de travail, donne des conseils pertinents. " .
                             "Question de l'utilisateur: " . $question;
    
    // Envoi de la question à Gemini
    $response = $gemini->askQuestion($contextualizedQuestion);
    
    // Mise à jour du timestamp de la dernière question
    $_SESSION['last_gemini_question'] = $currentTime;
    
    // Log de l'interaction (optionnel)
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    logGeminiInteraction($question, $response, $userId);
    
    // Formatage de la réponse
    $formattedResponse = formatGeminiResponse($response);
    
    // Réponse de succès
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => true,
        'question' => htmlspecialchars($question, ENT_QUOTES, 'UTF-8'),
        'response' => $formattedResponse,
        'timestamp' => date('Y-m-d H:i:s')
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    // Gestion des erreurs
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json; charset=utf-8');
    
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ], JSON_UNESCAPED_UNICODE);
    
    // Log de l'erreur
    error_log('Erreur Gemini AI: ' . $e->getMessage() . ' - Question: ' . (isset($question) ? $question : 'N/A'));
}
?>
