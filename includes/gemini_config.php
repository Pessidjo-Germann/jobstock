<?php
/**
 * Configuration pour l'API Google Gemini
 * 
 * Instructions d'installation :
 * 1. Obtenez une clé API Gemini sur : https://makersuite.google.com/app/apikey
 * 2. Remplacez 'YOUR_GEMINI_API_KEY_HERE' par votre vraie clé API
 * 3. Assurez-vous que curl est installé sur votre serveur
 */

// Configuration de l'API Gemini
define('GEMINI_API_KEY', 'YOUR_GEMINI_API_KEY_HERE'); // Remplacez par votre clé API
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent');

// Configuration des limites
define('GEMINI_MAX_QUESTION_LENGTH', 1000); // Longueur maximale de la question
define('GEMINI_MAX_TOKENS', 1000); // Nombre maximum de tokens dans la réponse
define('GEMINI_TIMEOUT', 30); // Timeout en secondes pour l'appel API

/**
 * Classe pour gérer les interactions avec l'API Gemini
 */
class GeminiAI {
    private $apiKey;
    private $apiUrl;
    
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
        
        // Appel à l'API via curl
        return $this->callGeminiAPI($data);
    }
    
    /**
     * Effectue l'appel curl vers l'API Gemini
     */
    private function callGeminiAPI($data) {
        $url = $this->apiUrl . '?key=' . $this->apiKey;
        
        $ch = curl_init();
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'User-Agent: JobStock-DigexBooker/1.0'
            ],
            CURLOPT_TIMEOUT => GEMINI_TIMEOUT,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        // Gestion des erreurs curl
        if ($response === false) {
            throw new Exception('Erreur de connexion à l\'API Gemini: ' . $error);
        }
        
        // Gestion des codes d'erreur HTTP
        if ($httpCode !== 200) {
            $errorData = json_decode($response, true);
            $errorMessage = isset($errorData['error']['message']) ? 
                           $errorData['error']['message'] : 
                           'Erreur API (Code: ' . $httpCode . ')';
            throw new Exception('Erreur API Gemini: ' . $errorMessage);
        }
        
        // Décodage de la réponse
        $responseData = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Erreur de décodage de la réponse JSON');
        }
        
        // Extraction de la réponse
        if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            return $responseData['candidates'][0]['content']['parts'][0]['text'];
        }
        
        throw new Exception('Format de réponse inattendu de l\'API Gemini');
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
