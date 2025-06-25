<?php
/**
 * Configuration pour l'API Google Gemini (Version alternative sans curl)
 * 
 * Instructions d'installation :
 * 1. Obtenez une clé API Gemini sur : https://makersuite.google.com/app/apikey
 * 2. Remplacez 'YOUR_GEMINI_API_KEY_HERE' par votre vraie clé API
 * 3. Cette version utilise file_get_contents() au lieu de curl
 */

// Configuration de l'API Gemini
define('GEMINI_API_KEY', 'AIzaSyC3cdxJrrEZ15dhj6TeU9hbEh2stAXeI2E'); // Votre clé API
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent');

// Configuration des limites
define('GEMINI_MAX_QUESTION_LENGTH', 1000); // Longueur maximale de la question
define('GEMINI_MAX_TOKENS', 1000); // Nombre maximum de tokens dans la réponse
define('GEMINI_TIMEOUT', 30); // Timeout en secondes pour l'appel API

/**
 * Classe pour gérer les interactions avec l'API Gemini (Version file_get_contents)
 */
class GeminiAI {
    private $apiKey;
    private $apiUrl;
    private $lastError = '';
    
    public function __construct() {
        $this->apiKey = GEMINI_API_KEY;
        $this->apiUrl = GEMINI_API_URL;
        
        if ($this->apiKey === 'YOUR_GEMINI_API_KEY_HERE') {
            throw new Exception('Veuillez configurer votre clé API Gemini dans includes/gemini_config.php');
        }
    }
    
    /**
     * Envoie une question à l'API Gemini et retourne la réponse
     */
    public function askQuestion($question) {
        // Validation de la question
        if (empty($question)) {
            throw new Exception('La question ne peut pas être vide');
        }
        
        if (strlen($question) > GEMINI_MAX_QUESTION_LENGTH) {
            throw new Exception('La question est trop longue (maximum ' . GEMINI_MAX_QUESTION_LENGTH . ' caractères)');
        }
        
        // Nettoyage et sécurisation de la question
        $question = trim($question);
        $question = htmlspecialchars($question, ENT_QUOTES, 'UTF-8');
        
        // Préparation des données pour l'API
        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $question
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'maxOutputTokens' => GEMINI_MAX_TOKENS,
                'temperature' => 0.7,
                'topP' => 0.8,
                'topK' => 40
            ]
        ];
        
        // Appel à l'API via file_get_contents
        return $this->callGeminiAPI($data);
    }
    
    /**
     * Effectue l'appel vers l'API Gemini avec file_get_contents
     */
    private function callGeminiAPI($data) {
        $url = $this->apiUrl . '?key=' . $this->apiKey;
        
        // Préparation du contexte HTTP
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => [
                    'Content-Type: application/json',
                    'User-Agent: JobStock-DigexBooker/1.0'
                ],
                'content' => json_encode($data),
                'timeout' => GEMINI_TIMEOUT,
                'ignore_errors' => true // Pour pouvoir lire les réponses d'erreur
            ]
        ]);
        
        // Exécution de la requête
        $response = file_get_contents($url, false, $context);
        
        // Vérification des erreurs
        if ($response === false) {
            $this->lastError = 'Erreur de connexion à l\'API Gemini';
            throw new Exception($this->lastError);
        }
        
        // Récupération du code de réponse HTTP
        $httpCode = 200; // Par défaut
        if (isset($http_response_header)) {
            foreach ($http_response_header as $header) {
                if (preg_match('/HTTP\/\d\.\d\s+(\d+)/', $header, $matches)) {
                    $httpCode = intval($matches[1]);
                    break;
                }
            }
        }
        
        // Gestion des codes d'erreur HTTP
        if ($httpCode !== 200) {
            $errorData = json_decode($response, true);
            $errorMessage = isset($errorData['error']['message']) ? 
                           $errorData['error']['message'] : 
                           'Erreur API (Code: ' . $httpCode . ')';
            $this->lastError = 'Erreur API Gemini: ' . $errorMessage;
            throw new Exception($this->lastError);
        }
        
        // Décodage de la réponse
        $responseData = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->lastError = 'Erreur de décodage de la réponse JSON: ' . json_last_error_msg();
            throw new Exception($this->lastError);
        }
        
        // Extraction de la réponse
        if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            $this->lastError = '';
            return $responseData['candidates'][0]['content']['parts'][0]['text'];
        }
        
        // Gestion des cas où l'IA refuse de répondre
        if (isset($responseData['candidates'][0]['finishReason'])) {
            $finishReason = $responseData['candidates'][0]['finishReason'];
            if ($finishReason === 'SAFETY') {
                $this->lastError = 'L\'IA a refusé de répondre pour des raisons de sécurité';
                throw new Exception($this->lastError);
            } elseif ($finishReason === 'RECITATION') {
                $this->lastError = 'L\'IA a refusé de répondre pour éviter la récitation';
                throw new Exception($this->lastError);
            }
        }
        
        $this->lastError = 'Format de réponse inattendu de l\'API Gemini';
        throw new Exception($this->lastError);
    }
    
    /**
     * Teste la connexion à l'API Gemini
     */
    public function testConnection() {
        try {
            $response = $this->askQuestion('Bonjour, peux-tu me répondre en français ?');
            return [
                'success' => true,
                'message' => 'Connexion réussie à l\'API Gemini',
                'response' => $response
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Erreur de connexion: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Retourne la dernière erreur survenue
     */
    public function getLastError() {
        return $this->lastError;
    }
}

/**
 * Fonction utilitaire pour nettoyer et formater la réponse de Gemini
 */
function formatGeminiResponse($response) {
    // Nettoyage de base
    $response = trim($response);
    
    // Conversion des retours à la ligne pour l'affichage HTML
    $response = nl2br(htmlspecialchars($response, ENT_QUOTES, 'UTF-8'));
    
    return $response;
}

/**
 * Fonction pour logger les interactions avec Gemini (optionnel)
 */
function logGeminiInteraction($question, $response, $userId = null) {
    $logFile = __DIR__ . '/../logs/gemini_interactions.log';
    $logDir = dirname($logFile);
    
    // Création du dossier logs s'il n'existe pas
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    $logEntry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'user_id' => $userId,
        'question_length' => strlen($question),
        'response_length' => strlen($response),
        'success' => true
    ];
    
    file_put_contents($logFile, json_encode($logEntry) . "\n", FILE_APPEND | LOCK_EX);
}
?>
