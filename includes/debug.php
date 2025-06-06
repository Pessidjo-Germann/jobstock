<?php
/**
 * Fichier de débogage pour diagnostiquer les problèmes de routage
 * À utiliser temporairement pour comprendre le flux de l'application
 */

session_start();

// Fonction pour logger les informations de débogage
function debugLog($message, $data = null) {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[$timestamp] $message";
    
    if ($data !== null) {
        $log_entry .= " | Data: " . print_r($data, true);
    }
    
    // Écrire dans un fichier de log (optionnel)
    // file_put_contents('debug.log', $log_entry . PHP_EOL, FILE_APPEND);
    
    // Afficher dans la console du navigateur (pour le développement)
    echo "<script>console.log(" . json_encode($log_entry) . ");</script>";
}

// Afficher les informations de débogage
echo "<div style='background: #f8f9fa; padding: 15px; margin: 10px; border: 1px solid #dee2e6; border-radius: 5px;'>";
echo "<h5>🐛 Informations de débogage</h5>";
echo "<strong>Page actuelle:</strong> " . basename($_SERVER['PHP_SELF']) . "<br>";
echo "<strong>URL complète:</strong> " . $_SERVER['REQUEST_URI'] . "<br>";
echo "<strong>Méthode:</strong> " . $_SERVER['REQUEST_METHOD'] . "<br>";

if (!empty($_GET)) {
    echo "<strong>Paramètres GET:</strong><br>";
    foreach ($_GET as $key => $value) {
        echo "&nbsp;&nbsp;- $key: " . htmlspecialchars($value) . "<br>";
    }
}

if (!empty($_POST)) {
    echo "<strong>Paramètres POST:</strong><br>";
    foreach ($_POST as $key => $value) {
        echo "&nbsp;&nbsp;- $key: " . htmlspecialchars($value) . "<br>";
    }
}

if (!empty($_SESSION)) {
    echo "<strong>Session:</strong><br>";
    foreach ($_SESSION as $key => $value) {
        if ($key !== 'password') { // Ne pas afficher les mots de passe
            echo "&nbsp;&nbsp;- $key: " . htmlspecialchars($value) . "<br>";
        }
    }
}

echo "<strong>Référent:</strong> " . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Aucun') . "<br>";
echo "<strong>User Agent:</strong> " . substr($_SERVER['HTTP_USER_AGENT'], 0, 100) . "...<br>";
echo "</div>";

// Logger automatiquement certaines actions
debugLog("Page visitée: " . basename($_SERVER['PHP_SELF']), $_GET);

// Fonction pour vérifier la cohérence du routage
function checkRoutingConsistency() {
    $current_page = basename($_SERVER['PHP_SELF']);
    $issues = [];
    
    switch ($current_page) {
        case 'job.php':
            if (!isset($_GET['research']) && !isset($_GET['job'])) {
                $issues[] = "job.php appelé sans paramètres appropriés";
            }
            break;
        case 'service.php':
            if (!isset($_GET['job'])) {
                $issues[] = "service.php appelé sans paramètre 'job'";
            }
            break;
    }
    
    if (!empty($issues)) {
        echo "<div style='background: #fff3cd; padding: 15px; margin: 10px; border: 1px solid #ffeaa7; border-radius: 5px;'>";
        echo "<h6>⚠️ Problèmes de routage détectés:</h6>";
        foreach ($issues as $issue) {
            echo "<li>" . htmlspecialchars($issue) . "</li>";
        }
        echo "</div>";
    }
}

// Vérifier la cohérence du routage
checkRoutingConsistency();
?>
