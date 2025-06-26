<?php
// Script d'installation du système de chat
include('./actions/conbd.php');

echo "<h2>Installation du système de chat temps réel</h2>";
echo "<hr>";

// Lire le fichier SQL
$sql_content = file_get_contents('./chat_system.sql');

if (!$sql_content) {
    die("Erreur: Impossible de lire le fichier chat_system.sql");
}

// Séparer les requêtes SQL
$sql_queries = explode(';', $sql_content);

$success_count = 0;
$error_count = 0;

foreach ($sql_queries as $query) {
    $query = trim($query);
    
    if (empty($query) || strpos($query, '--') === 0) {
        continue; // Ignorer les commentaires et lignes vides
    }
    
    try {
        if (mysqli_query($link, $query)) {
            echo "✅ Requête exécutée avec succès<br>";
            $success_count++;
        } else {
            echo "❌ Erreur: " . mysqli_error($link) . "<br>";
            echo "Requête: " . htmlspecialchars(substr($query, 0, 100)) . "...<br>";
            $error_count++;
        }
    } catch (Exception $e) {
        echo "❌ Exception: " . $e->getMessage() . "<br>";
        $error_count++;
    }
}

echo "<hr>";
echo "<h3>Résultats de l'installation</h3>";
echo "✅ Requêtes réussies: $success_count<br>";
echo "❌ Erreurs: $error_count<br>";

if ($error_count === 0) {
    echo "<div style='background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-top: 20px;'>";
    echo "<strong>🎉 Installation terminée avec succès !</strong><br>";
    echo "Le système de chat est maintenant prêt à être utilisé.";
    echo "</div>";
    
    echo "<h3>Structure créée :</h3>";
    echo "<ul>";
    echo "<li><strong>chat_conversations</strong> - Table des conversations entre clients et prestataires</li>";
    echo "<li><strong>chat_messages</strong> - Table des messages de chat</li>";
    echo "<li><strong>chat_notifications</strong> - Table des notifications (optionnel)</li>";
    echo "</ul>";
    
    echo "<h3>Prochaines étapes :</h3>";
    echo "<ol>";
    echo "<li>Testez le système en vous connectant sur l'application</li>";
    echo "<li>Allez sur la page d'un service et cliquez sur 'Chat Direct'</li>";
    echo "<li>Vérifiez que la conversation se crée et que les messages s'envoient</li>";
    echo "<li>Testez le chat temps réel depuis la page user/chat.php</li>";
    echo "</ol>";
} else {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-top: 20px;'>";
    echo "<strong>⚠️ Installation partiellement réussie</strong><br>";
    echo "Certaines erreurs se sont produites. Vérifiez les détails ci-dessus.";
    echo "</div>";
}

// Vérifier les tables existantes
echo "<h3>Vérification des tables :</h3>";
$tables_to_check = ['chat_conversations', 'chat_messages', 'chat_notifications'];

foreach ($tables_to_check as $table) {
    $check_query = "SHOW TABLES LIKE '$table'";
    $result = mysqli_query($link, $check_query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "✅ Table '$table' existe<br>";
    } else {
        echo "❌ Table '$table' n'existe pas<br>";
    }
}

mysqli_close($link);
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    line-height: 1.6;
}
</style>
